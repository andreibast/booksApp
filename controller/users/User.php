<?php
require_once __DIR__.'/../model/Users.php'; //to have the object

class User extends Users{


    public function sessionStart($lifetime, $path, $domain, $secure, $httpOnly){
        session_set_cookie_params($lifetime, $path, $domain, $secure, $httpOnly);
        session_start();
    }

    public function login_token(){
        $_SESSION['id'] = 264;

        if(empty($_SESSION['key_login'])){
            $_SESSION['key_login'] = bin2hex(random_bytes(32));
            $_SESSION['start_login'] = time();
        }

        if(!empty($_SESSION['key_login'])){

            $_SESSION['expire_login'] = $_SESSION['start_login'] + (240); //session time set to 4min
            $now = time();
            if($now > $_SESSION['expire_login']){
                unset( $_SESSION['key_login']);
                unset( $_SESSION['expire_login']);

                header("location: ../../view/login.php"); //redirect to login page after session expiration
            }
        }
    }

    
    public function login($csrf_login_method){
        $email_grabbed =  trim(htmlspecialchars($_POST['login_email']));
        $password_grabbed = trim(htmlspecialchars($_POST['login_password']));
    
        if(isset($_POST['login_email']) && isset($_POST['login_password']) ){
    
            if(hash_equals($csrf_login_method, $_POST['token_login'])){

                    if(empty($email_grabbed) || empty($password_grabbed)){
                        $_SESSION['message_login'] = "Please complete all the fields!";
                        $_SESSION['msg_type_login'] = "danger";
                        header("location: ../");
                    }elseif(parent::verifyUser($_POST['login_email'], $password_grabbed) == true){
                        $_SESSION['msg_type_login'] = "success"; 
                        header("location: ../view/homepage.php");
                    }else{
                        $_SESSION['message_login'] = "Incorrect email/password!";
                        $_SESSION['msg_type_login'] = "danger";
                        header("location: ../");
                    }
            }else{
                $_SESSION['message_login'] = "The token has expired! Please refrish the page and try again!";
                $_SESSION['msg_type_login'] = "warning";
                header("location: ../");
            }
        }else{
            $_SESSION['message_login'] = "Please complete all the fields!";
            $_SESSION['msg_type_login'] = "danger";
            header("location: ../");
        }
    }


    public function register_token(){
        $_SESSION['id'] = 326;

        if(empty($_SESSION['key'])){
            $_SESSION['key'] = bin2hex(random_bytes(32));
            $_SESSION['start'] = time();
        }
    
        if(!empty($_SESSION['key'])){
    
            $_SESSION['expire'] = $_SESSION['start'] + (180);
            $now = time();
            if($now > $_SESSION['expire']){
    
                unset( $_SESSION['key']);
                unset( $_SESSION['expire']);
    
                header("location: ../../view/register.php"); //redirect to login page after session expiration
            }
        }
    }

    public function register($csrf_token){
        if(isset($_POST['new_surname']) && isset($_POST['new_email'])  && isset($_POST['new_password']) && isset($_POST['new_password_check']) ){

            if(hash_equals($csrf_token, $_POST['token'])){
               
                $new_prenume = trim(htmlspecialchars($_POST['new_surname']));
                $new_email_address = trim(htmlspecialchars($_POST['new_email']));
                $new_password = password_hash(trim(htmlspecialchars($_POST['new_password'])), PASSWORD_DEFAULT);
                $new_password_check = password_hash(trim(htmlspecialchars($_POST['new_password_check'])), PASSWORD_DEFAULT);
        
                if(strcmp($_POST['new_password'], $_POST['new_password_check']) == 0){
        
                    if(parent::verifyUserDuplicate($new_email_address) == true){
                        $_SESSION['message_register'] = "There is already an account with the given email address!";
                        $_SESSION['msg_type_register'] = "warning";
                    }elseif(parent::registerUser($new_prenume, $new_email_address, $new_password) == true){
                        $_SESSION['message_register'] = "The new username has been created!";
                        $_SESSION['msg_type_register'] = "success";
                    }else{
                        $_SESSION['message_register'] = "Something in the process went wrong!";
                        $_SESSION['msg_type_register'] = "danger";
                    }
        
                }elseif(empty($new_prenume) || empty($new_email_address) || empty($new_password) || empty($new_password_check)){
                    $_SESSION['message_register'] = "Please complete all the fields!";
                    $_SESSION['msg_type_register'] = "danger";
                }
                else{
                    $_SESSION['message_register'] = "Please verify the passwords again!";
                    $_SESSION['msg_type_register'] = "danger";
                }
            }else{
                $_SESSION['message_register'] = "The token has expired! Please refrish the page and try again!";
                $_SESSION['msg_type_register'] = "warning";
            }
        }else{
            $_SESSION['message_register'] = "Please make sure you completed all fields correctly and respect the formats!";
            $_SESSION['msg_type_register'] = "danger";  
        }
        
        header("location: ../view/registration.php");
    }

    public function logout(){
        unset($_SESSION['curent_username']);
        session_destroy(); 
        header("location: ../");
    }

}

//========================================================================
//LOGIN USER
//========================SESSION SECTION=================================
$loginUser = new User();  
$loginUser->sessionStart(0, '/', 'localhost', false, false);
$loginUser->login_token();

$csrf_login = hash_hmac('sha256','This is LoginUser.php', $_SESSION['key_login']);

//========================INTERACTION SECTION=============================
if(isset($_POST['login_user'])){   
    $loginUser->login($csrf_login);
}

if(isset($_POST['user_logout'])){
    $loginUser->logout();
}
unset($loginUser); //destroy the object from memory


//====================================================================
//REGISTER USER
//========================SESSION SECTION=============================
$registerUser = new User();
$registerUser->register_token();

$csrf = hash_hmac('sha256','This is RegisterUser.php', $_SESSION['key']);

//========================INTERACTION SECTION=========================
if(isset($_POST['new_user'])){
    $registerUser->register($csrf);
}

unset($registerUser); //destroy the object from memory




