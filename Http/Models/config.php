<?php
    //Enter your database connection details here.
    $host = 'localhost'; //HOST NAME.

    $db_username = 'root'; //Database Username
    $db_password = ''; //Database Password
    $db_name = 'books.app'; //Database Name

    try
    {
        $pdo = new PDO('mysql:host='. $host .';dbname='.$db_name, $db_username, $db_password);
    }
    catch (PDOException $e)
    {
        exit('Error Connecting To DataBase');
    }
?>