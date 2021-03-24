<?php 
//========================REQUIRE SECTION=============================
require_once __DIR__.'/../users/LoginUser.php'; //uses the same session
require_once __DIR__.'/../../Models/Books.php'; //to have the object

$books = new Books();

//========================INTERACTION SECTION=============================
if(isset($_POST['add_book']) ){
  $books->addBook();
}

unset($books); //destroy the object from memory