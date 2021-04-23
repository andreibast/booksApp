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
                    }elseif(parent::verifyUser($_POST['login_email'], $password_grabbed) == false){
                        $temp_current_user_name = 'good user'; 
                    
                        $_SESSION['curent_username'] = $temp_current_user_name;
                        $_SESSION['msg_type_login'] = "success"; 
                        header("location: ../view/homepage.php");

                    }else{
                        $_SESSION['message_login'] = "Incorrect email/password!";
                        $_SESSION['msg_type_login'] = "danger";
                        header("location: ../");
                    }


                    

                    // if($email_grabbed == parent::checkUser($email_grabbed)[2] && password_verify($password_grabbed, parent::checkUser($email_grabbed)[3]) ){
        
                    //     $temp_current_user_name = parent::checkUser($email_grabbed)[1]; 
                    
                    //     $_SESSION['curent_username'] = $temp_current_user_name;
                    //     $_SESSION['msg_type_login'] = "success"; 
                    //     header("location: ../../view/homepage.php");
                       

                    // }elseif(empty($email_grabbed) || empty($password_grabbed)){
                    //     $_SESSION['message_login'] = "Please complete all the fields!";
                    //     $_SESSION['msg_type_login'] = "danger";
                    //     header("location: ../");
                    
                    // }else{
        
                    //     $_SESSION['message_login'] = "Incorrect email/password!" . var_dump(parent::checkUser($email_grabbed));
                    //     $_SESSION['msg_type_login'] = "danger";
                    //     header("location: ../");
                        
                    // }
                   
                
                
                //parent::closeConnection(parent::login());

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
    
                header("location: ../../view/login.php"); //redirect to login page after session expiration
            }
        }
    }

    public function register($csrf_token){
        
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
// $registerUser = new User();
// $registerUser->sessionStart(0, '/', 'localhost', false, false);
// $registerUser->register_token();

// $csrf = hash_hmac('sha256','This is RegisterUser.php', $_SESSION['key']);

// //========================INTERACTION SECTION=========================
// if(isset($_POST['new_user'])){
//     $registerUser->register($csrf);
// }

// unset($registerUser); //destroy the object from memory




