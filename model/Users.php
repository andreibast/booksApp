<?php

include 'interfaces/ConnectionData.php';
require_once __DIR__.'/../lib/Database.php';

class Users extends Database implements ConnectionData{

    public function __construct($user_domain = self::USER_DOMAIN, $user_name = self::USER_NAME, $user_password = self::USER_PASSWORD, $user_database = self::USER_DATABASE){
        $this->user_domain = $user_domain;
        $this->user_name = $user_name;
        $this->user_password = $user_password;
        $this->user_database = $user_database;
    }




    public function openConnection(){
  
        try{
            return parent::openConnection();
        }catch(PDOException $e){
            echo $sql . "<br>" . $e->getMessage();
        }
    }

    // public function closeConnection(){
    //     try{
    //         return parent::closeConnection();
    //     }catch(PDOException $e){
    //         echo $sql . "<br>" . $e->getMessage();
    //     }
    // }

    public function verifyUser($userEmail, $userPass){
        try{
            $openConn = parent::openConnection();

            $stmt = $openConn->prepare("SELECT * FROM users WHERE email = $userEmail");
            $stmt->execute();
            $user = $stmt->fetch();

            if ($user && password_verify($userPass, $user['parola']))
            {
                return true;
            } else {
                return false;
            }

        }catch(PDOException $e){
            echo $e->getMessage();
        }
        parent::closeConnection($openConn);
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
                header("location: ../../view/registration.php");
            }
        }else{
            $_SESSION['message_register'] = "Please make sure you completed all fields correctly and respect the formats!";
            $_SESSION['msg_type_register'] = "danger";  
        }
        
        header("location: ../../view/registration.php");
    }

}


// $obj = new Users();
// echo "<pre>";
// echo "<br>";
// var_dump($obj->checkUser('drtyeryrey@gsgd.df'));