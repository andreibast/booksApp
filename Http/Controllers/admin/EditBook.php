<?php 
//========================REQUIRE SECTION=================================
require_once __DIR__.'/../users/LoginUser.php';
require_once __DIR__.'/../../Models/Books.php'; //to have the object

$editBook = new Books();
$editBook->editBookTarget();


$givenPicturePath1;

if(strcmp($editBook->picture, '150x212.jpg') == 1){
    $givenPicturePath = "../../../public/images/";
}else{
    $givenPicturePath = '../../../public/images/user_books_covers/';
}



//========================INTERACTION SECTION=============================
if(isset($_POST['edit_book']) ){
    $editBook->editBook();
    unset($editBook); //destroy the object from memory
}

