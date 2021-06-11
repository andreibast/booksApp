<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-16">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Books App</title>

</head>
<body>
    <?php include("view/templates/layout.css.php"); ?>

    <?php

    require_once "lib/Database.php";
    require_once "model/Users.php";
    require 'controller/User.php';

    $db = new Database();
    $user_model = new Users($db);
    $user_controller = new User($user_model);

    $user_controller->sessionStart(0, '/', 'localhost', false, false);

    $request = preg_replace("|/*(.+?)/*$|", "\\1", $_SERVER['PATH_INFO']);
    $uri = explode('/', $request);
    
    $uri0 = isset($uri[0]); // first value after index.php
    $uri1 = isset($uri[1]); // second value after index.php

    if($uri0 && $uri[0] === ''){ //redirect on root URL
        header("location: http://localhost/books.andreibasturescu/index.php/login");
    }elseif($uri0  && $uri[0] === 'login'){ //default opening page (login)
        $user_controller->login_token(); //prepare session settings for login
        $user_controller->csrf_login(); //to give token for the form that follows
        $user_controller->index(); //inject the form page
    }elseif($uri0  && $uri[0] === 'home'){ //see app page
        if(isset($_POST['login_user'])){ 
            $user_controller->login($user_controller->csrf_login()); //process login
        }
        $user_controller->home(); //inject the homepage
        if(isset($_POST['user_logout'])){
            $user_controller->logout();
        }
    }elseif($uri0  && $uri[0] === 'register'){ //register page
        $user_controller->register_token(); //prepare session settings for register
        $user_controller->csrf_register(); //give a register token
        $user_controller->registerPage(); //to give registration page
        if(isset($_POST['new_user'])){
            $user_controller->register($user_controller->csrf_register()); //process registration
        }

    }elseif($uri0 && $uri[0] === 'home' && $uri1 && $uri[1] === 'add'){
        echo 'work in progress...';
    }elseif($uri0 && $uri[0] === 'home' && $uri1 && $uri[1] === 'find'){
        echo 'work in progress...';
    }elseif($uri0 && $uri[0] === 'home' && $uri1 && $uri[1] === 'favorites'){
        echo 'work in progress...';
    }elseif($uri0 && $uri[0] === 'admin'){
        // header("location: http://localhost/books.andreibasturescu/index.php/admin/dashboard");
    }elseif($uri0 && $uri[0] === 'admin' && $uri1 && $uri[1] === 'dashboard'){
        echo 'work in progress...';
    }elseif($uri0 && $uri[0] === 'admin' && $uri1 && $uri[1] === 'new_book'){
        echo 'work in progress...';
    }elseif($uri0 && $uri[0] === 'admin' && $uri1 && $uri[1] === 'edit'){
        echo 'work in progress...';
    }elseif($uri0 && $uri[0] === 'admin' && $uri1 && $uri[1] === 'manage_books'){
        echo 'work in progress...';
    }else{ //force redirect any other given URL to login page
        header("location: http://localhost/books.andreibasturescu/index.php/login");
    }

    ?>

    <?php include("view/templates/layout.js.php"); ?>
</body>
</html>