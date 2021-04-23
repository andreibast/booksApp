<?php 
//========================SESSION SECTION=============================
//     require_once(__DIR__.'/../../model/Users.php');

//     $loginUser = new Users();  
//     $loginUser->sessionStart(0, '/', 'localhost', false, false);
//     $loginUser->login_token();
    
//     $csrf_login = hash_hmac('sha256','This is LoginUser.php', $_SESSION['key_login']);

// //========================INTERACTION SECTION=============================
//     if(isset($_POST['login_user'])){   
//         $loginUser->login($csrf_login);
//     }

//     if(isset($_POST['user_logout'])){
//         $loginUser->logout();
//     }

//     unset($loginUser); //destroy the object from memory