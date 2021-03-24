<?php 
//========================REQUIRE SECTION=================================
require_once __DIR__.'/../users/LoginUser.php';
require_once __DIR__.'/../../Models/Books.php'; //to have the object



$deleteBook = new Books();

// $givenPicturePath;

// if(strcmp($editBook->picture, '212x150.jpg')){
//     $givenPicturePath = "../../../public/images/";
// }else{
//     $givenPicturePath = '../../public/images/user_books_covers/';
// }

//========================INTERACTION SECTION=============================
if(isset($_POST['delete']) ){
    $deleteBook->deleteBook();
}

//unset($deleteBook); //destroy the object from memory