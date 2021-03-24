<?php

include 'interfaces/ConnectionData.php';
include 'abstract/UserFeatures.php';

class Users implements ConnectionData{


    



    public function __construct($user_domain = self::USER_DOMAIN, $user_name = self::USER_NAME, $user_password = self::USER_PASSWORD, $user_database = self::USER_DATABASE){
        $this->user_domain = $user_domain;
        $this->user_name = $user_name;
        $this->user_password = $user_password;
        $this->user_database = $user_database;
    }

    public function sessionStart($lifetime, $path, $domain, $secure, $httpOnly){
        session_set_cookie_params($lifetime, $path, $domain, $secure, $httpOnly);
        session_start();
    }


    public function login($csrf_login_method){
  
        $conn = mysqli_connect("localhost","root","","books.app"); 
        $result = mysqli_query($conn,"select * from users");
    
        $email_grabbed =  mysqli_real_escape_string($conn, trim(htmlspecialchars($_POST['login_email'])));
        $password_grabbed =  mysqli_real_escape_string($conn, trim(htmlspecialchars($_POST['login_password'])));
    
        if(isset( $_POST['login_email']) && isset($_POST['login_password']) ){
    
            if(hash_equals($csrf_login_method, $_POST['token_login'])){
                while($user_row = mysqli_fetch_row($result)) {
    
                    if($email_grabbed == $user_row[2] && password_verify($password_grabbed, $user_row[3]) ){
        
                        $temp_current_user_name = $user_row[1]; 
                    
                        $_SESSION['curent_username'] = $temp_current_user_name;
                        $_SESSION['msg_type_login'] = "success"; 
                        header("location: ../../../resources/views/homepage.php");
                        break;

                    }elseif(empty($email_grabbed) || empty($password_grabbed)){
                        $_SESSION['message_login'] = "Please complete all the fields!";
                        $_SESSION['msg_type_login'] = "danger";
                        header("location: ../../../");
                    
                    }else{
        
                        $_SESSION['message_login'] = "Incorrect email/password!";
                        $_SESSION['msg_type_login'] = "danger";
                        header("location: ../../../");
                        continue;
                    }
                    break;
                }
                mysqli_close($conn);

            }else{
                $_SESSION['message_login'] = "The token has expired! Please refrish the page and try again!";
                $_SESSION['msg_type_login'] = "warning";
                header("location: ../../../");
            }
    
        }else{
            $_SESSION['message_login'] = "Please complete all the fields!";
            $_SESSION['msg_type_login'] = "danger";
            header("location: ../../../");
        }
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

                header("location: ../../../resources/views/login.php"); //redirect to login page after session expiration
            }
        }
    }


    public function register($csrf_token){
        if(isset( $_POST['new_surname']) && isset($_POST['new_email'])  && isset($_POST['new_password']) && isset($_POST['new_password_check']) ){

            if(hash_equals($csrf_token, $_POST['token'])){
                $mysqli4 = new mysqli("localhost","root","","books.app") or die(mysqli_error($mysqli4));
    
                $new_prenume = mysqli_real_escape_string($mysqli4, (trim(htmlspecialchars($_POST['new_surname']))));
                $new_email_address = mysqli_real_escape_string($mysqli4,(htmlspecialchars(trim($_POST['new_email']))));
                $new_password = mysqli_real_escape_string($mysqli4, password_hash(trim(htmlspecialchars($_POST['new_password'])), PASSWORD_DEFAULT));
                $new_password_check = mysqli_real_escape_string($mysqli4, password_hash(trim(htmlspecialchars($_POST['new_password_check'])), PASSWORD_DEFAULT));
        
                if(strcmp($_POST['new_password'], $_POST['new_password_check']) == 0){
        
                    $mysqli4->query("INSERT INTO users (id, prenume, email, parola) VALUES(NULL,'$new_prenume','$new_email_address','$new_password') ") or die($mysqli4->error());
        
                    $_SESSION['message_register'] = "The new username has been created!";
                    $_SESSION['msg_type_register'] = "success";
        
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
                header("location: ../../../resources/views/registration.php");
            }
        }else{
            $_SESSION['message_register'] = "Please make sure you completed all fields correctly and respect the formats!";
            $_SESSION['msg_type_register'] = "danger";  
        }
        
        header("location: ../../../resources/views/registration.php");
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
    
                header("location: ../../resources/views/login.php"); //redirect to login page after session expiration
            }
        }
    }


    public function logout(){
        unset($_SESSION['curent_username']);
        session_destroy(); 
        header("location: ../../../");
    }

}