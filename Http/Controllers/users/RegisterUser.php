<?php 
//========================SESSION SECTION=============================
    require_once(__DIR__.'/../../../Http/Models/Users.php');

    $registerUser = new Users();
    $registerUser->sessionStart(0, '/', 'localhost', false, false);
    $registerUser->register_token();

    $csrf = hash_hmac('sha256','This is RegisterUser.php', $_SESSION['key']);

//========================INTERACTION SECTION=========================
    if(isset($_POST['new_user'])){
        $registerUser->register($csrf);
    }

    unset($registerUser); //destroy the object from memory