<?php

class Users{

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

            $this->db->closeConnection($openConn);

        }catch(PDOException $e){
            echo $e->getMessage();
        }
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
            $this->db->closeConnection($openConn);

        }catch(PDOException $e){
            echo $e->getMessage();
        }  
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

            $this->db->closeConnection($openConn);

        }catch(PDOException $e){
            echo $e->getMessage();
        }
    }

}
