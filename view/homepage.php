<?php include("layout.css.php"); ?>
<div class="background-img img-fluid">

    <!-- NAVBAR -->
    <?php  require_once(__DIR__.'/../controller/User.php');  ?>
    <?php require_once '../controller/Book.php';  ?>

    <?php
    $current_user_name="Guest";
    $for_admin = "";
        if(isset($_SESSION['curent_username'])): ?>
            <?php 
                $current_user_name = $_SESSION['curent_username'];
                if(isset($_POST['admin_button']) ){
                    header("location: adminarea/admin.php?admin_dashboard=Dashboard&admin_edit=Edit+Book");
                }
            ?>
    <?php endif ?>

    <?php 
        if(isset($_POST['admin_button']) ){
            $for_admin = "<p class= 'alert alert-danger'>Please log in first!<p>";
        }
    ?>

    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a href="#"><img class= "logo" src="../public/images/main/bffb7a55-1455-4a54-9b5a-028fb7e9f17a_200x200.png"></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item ">
                    

                    <form action="" method = "POST">
                    
                        <button type="submit" name="admin_button" class="btn btn-dark mt-2">Admin Area</button>
                    </form>

                </li>
                <p class="ml-3"><?php echo $for_admin;  ?></p>
            </ul>

            <div class="form-inline my-2 my-lg-0 mr-5" >
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item dropdown">

                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <div class="text-center">
                                <img src="../public/images/main/profile_default_image.jpg" class="rounded-circle homepage-nav-profile-image">
                                Welcome, <?php echo  $current_user_name;  ?>
                            </div>
                        </a>

                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item disabled" href="#" disabled>Favorite books</a>
                        <a class="dropdown-item disabled" href="#">Edit Profile</a>
                        <div class="dropdown-divider"></div>
                        <form action="../controller/User.php" method ="POST" >
                            <button type="submit" name="user_logout" class="dropdown-item">Logout</button>
                        </form>

                        </div>
                    </li>
                </ul>
            </div>

        </div>
    </nav>


    <!-- MAIN CONTENT -->
    <div class="container mb-5 col-md-10 homepage-main-container" >

        <!-- Individual card-->
        <?php 
                $obj = new Book();    
                foreach($obj->displayBooks() as $book){  ?>

        <?php
                $givenPicturePath;
                    if(strcmp($book['picture'], '150x212.png') == 0){
                        $givenPicturePath = "../public/images/";
                    }else{
                        $givenPicturePath = '../public/images/user_books_covers/';
                    }
                ?>
                    

        <div class="row ">
            <div class="card col-md-11 mb-4 mt-3 homepage-card-container">
                <div class="card-body homepage-card-body">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-3">
                                <img src="<?php echo $givenPicturePath . $book['picture']; ?>"  class="homepage-card-cover"> 
                            </div>
                            <div class="col-md-8 ml-3">
                                    <h2 class="card-title"><?php echo $book['title'];  ?></h2>
                                    <h5 class="card-title"><?php echo $book['authors'];  ?></h5>
                                    <h6 class="card-title" ><?php echo $book['category'];  ?></h6>

                                <p class="card-text" class="homepage-card-description"><?php echo $book['description'];  ?></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <?php unset($obj); }  ?>

    </div>


    <!-- FOOTER-->
    <div class="jumbotron mb-0  bg-dark text-center homepage-footer">
        <div class="container">
            <p class="lead text-light">All Rights Reserved. Andrei Basturescu 2021</p>
        </div>
    </div>

</div>



    <?php include("layout.js.php"); ?>
