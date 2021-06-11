<?php  
    // require_once(__DIR__.'/../controller/User.php');

    // require "index.php";
    // ob_start();

    // if(isset($_SESSION['curent_username'])){
    //     require_once 'lib/Database.php';
    //     require_once "model/Books.php";
    //     require_once 'controller/Book.php';
    
    //     $db_books = new Database();
    //     $book_model = new Books($db_books);
    //     $book_controller = new Book($book_model); 
    // }
       

     
    $current_user_name="Guest";
    $for_admin = "";
    if(isset($_SESSION['curent_username'])){
        $current_user_name = $_SESSION['curent_username'];
        if(isset($_POST['admin_button']) ){
            header("location: adminarea/admin.php?admin_dashboard=Dashboard&admin_edit=Edit+Book");
        }
    } 

    if(isset($_POST['admin_button']) ){
        $for_admin = "<p class= 'alert alert-danger'>Please log in first!<p>";
    }

?>

<div class="background-img img-fluid">
   <!-- NAVBAR--><?php include "components/navbar.php"; ?>

    <?php 
        if((isset($_GET['current_profile']) || isset($_GET['favorite_page'])) && isset($_SESSION['curent_username'])){
            include("subpages/profilepage.php");
        }elseif(isset($_GET['current_profile']) || isset($_GET['favorite_page'])){
            echo "<p class= 'alert alert-warning text-center'>Please login first!<p>";
            include("subpages/mainpage.php");
        }else{
            include("subpages/mainpage.php");
        };
        // ob_end_flush();
    ?>

    <!-- FOOTER--><?php include "components/footer.php"; ?>
</div>