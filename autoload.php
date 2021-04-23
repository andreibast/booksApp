<?php

$GLOBALS['base'] ='http://localhost/books.andreibasturescu/';

spl_autoload_register(function ($class) {
    require ('controller/admin/'.$class . '.php');
    require ('controller/users/'.$class . '.php');
    require ('model/'.$class . '.php');
});