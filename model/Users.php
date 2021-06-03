<?php
// include 'interfaces/ConnectionData.php';
// require_once __DIR__.'/../lib/Database.php';

class Users{

    // public function __construct($user_domain = self::USER_DOMAIN, $user_name = self::USER_NAME, $user_password = self::USER_PASSWORD, $user_database = self::USER_DATABASE){
    //     $this->user_domain = $user_domain;
    //     $this->user_name = $user_name;
    //     $this->user_password = $user_password;
    //     $this->user_database = $user_database;
    // }
    
    protected $db;

    public function __construct($database){
        $this->db = $database;
    }


    public function openConnection(){
  
        try{
            return $this->db->openConnection();
        }catch(PDOException $e){
            echo $sql . "<br>" . $e->getMessage();
        }
    }

    public function verifyUser($userEmail, $userPass){
        try{
            $openConn = $this->db->openConnection();

            $stmt = $openConn->prepare("SELECT * FROM users WHERE email = '".$userEmail."'");
            $stmt->execute();
            $user = $stmt->fetch();

            if (password_verify($userPass, $user["parola"])){
                $_SESSION['curent_username'] = $user["prenume"];
                $_SESSION['curent_user_id'] = $user["id"];
                return true;
            } else {
                return false;
            }

        }catch(PDOException $e){
            echo $e->getMessage();
        }
        $this->db->closeConnection($openConn);
    }

    public function verifyUserDuplicate($userEmail){
        try{
            $openConn = $this->db->openConnection();

            $stmt = $openConn->prepare("SELECT * FROM users WHERE email = '".$userEmail."'");
            $stmt->execute();
            $user = $stmt->fetch();

            if (!empty($user)){
                return true;
            } else {
                return false;
            }
        }catch(PDOException $e){
            echo $e->getMessage();
        }
        $this->db->closeConnection($openConn);
    }

    public function registerUser($prenume, $email, $parola){
        try{
            $openConn = $this->db->openConnection();

            $stmt = $openConn->prepare("INSERT INTO users (id, prenume, email, parola) VALUES(NULL,'".$prenume."','".$email."','".$parola."') ");

            if($stmt->execute()){
                return true;
            }else{
                return false;
            }

        }catch(PDOException $e){
            echo $e->getMessage();
        }
        $this->db->closeConnection($openConn);
    }
}
