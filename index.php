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
    require_once 'controller/User.php';

    $db = new Database();
    $user_model = new Users($db);
    $user_controller = new User($user_model);

    $user_controller->sessionStart(0, '/', 'localhost', false, false);
    $user_controller->login_token();
    $csrf_login = hash_hmac('sha256','This is LoginUser.php', $_SESSION['key_login']);   


    $request = preg_replace("|/*(.+?)/*$|", "\\1", $_SERVER['PATH_INFO']);
    $uri = explode('/', $request);
    
    $uri0 = isset($uri[0]);
    $uri1 = isset($uri[1]);

    // isset($_POST['login_user'])

    if($uri[0] === 'home'){
        $user_controller->login($csrf_login);
    }else{
        include("view/subpages/login.php");
    }

    // unset($db);
    ?>

    <?php include("view/templates/layout.js.php"); ?>
</body>
</html>