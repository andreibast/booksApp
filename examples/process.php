<?php 



$id = 0;
$title = "";
$authors = '';
$category = '';
$picture = '';
$description = '';
$date_added = '';

$mysqli2 = new mysqli("localhost","root","","books.app") or die(mysqli_error($mysqli2));

if(isset($_GET['admin_edit']) ){
    //header("location: ../../views/adminarea/admin.php?admin_edit=Edit+Book");


    $id = $_GET['admin_edit'];

    $result= $mysqli2->query("SELECT * FROM books WHERE id= $id") or die($mysqli2->error());




        $row = $result->fetch_array();
        $title = $row['title'];
        $authors = $row['authors'];
        $category = $row['category'];
        $picture = $row['picture'];
        $description = $row['description'];

}



if(isset($_GET['edit_book']) ){
    

    $id = $_GET['id'];

    $title = $_GET['edit_title'];
    $authors = $_GET['edit_authors'];
    $category = $_GET['edit_category'];
    $picture = $_GET['edit_picture'];
    $description = $_GET['edit_description'];

   $mysqli2->query("UPDATE books SET title='$title', authors='$authors', category='$category', picture='$picture', description='$description'  WHERE id= $id") or die($mysqli2->error());
   header("location: http://localhost/books.andreibasturescu/examples/index.php");
} 
