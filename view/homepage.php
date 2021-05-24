<?php include("layout.css.php"); ?>
<?php  require_once(__DIR__.'/../controller/User.php'); ?>
<?php require_once '../controller/Book.php'; ?>

<?php
    ob_start();
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

    <!-- NAVBAR -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a href="/books.andreibasturescu/view/homepage.php"><img class= "logo" src="../public/images/main/bffb7a55-1455-4a54-9b5a-028fb7e9f17a_200x200.png"></a>
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
                <p class="ml-3"><?php echo $for_admin; ?></p>
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

                        <a class="dropdown-item" href="../view/homepage.php">Go To Main Site</a>

                        <form action="" method="GET">
                            <input type="submit" name="favorite_page" class="dropdown-item" value="Favorite books">

                            <input type="submit" name="current_profile" class="dropdown-item" value="My Profile">
                        </form>

                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="../view/registration.php">Create New User</a>
                        <div class="dropdown-divider"></div>
                        <form action="../controller/User.php" method ="POST" >
                            <?php    
                                if(isset($_SESSION['curent_username'])){
                                    echo "<button type='submit' name='user_logout' class='dropdown-item'>Logout</button>";
                                }else{
                                    echo "<a href='../' class='dropdown-item'>To Login Page</a>";
                                }
                            ?>
                        </form>

                        </div>
                    </li>
                </ul>
            </div>

        </div>
    </nav>

    <?php 
        if((isset($_GET['current_profile']) || isset($_GET['favorite_page'])) && isset($_SESSION['curent_username'])){
            include("subpages/profilepage.php");
        }elseif(isset($_GET['current_profile']) || isset($_GET['favorite_page'])){
            echo "<p class= 'alert alert-warning text-center'>Please login first!<p>";
            include("subpages/mainpage.php");
        }else{
            include("subpages/mainpage.php");
        };
        ob_end_flush();
    ?>


    <!-- FOOTER-->
    <div class="jumbotron mb-0  bg-dark text-center homepage-footer">
        <div class="container">
            <p class="lead text-light">All Rights Reserved. Andrei Basturescu 2021</p>
        </div>
    </div>

</div>


<?php include("layout.js.php"); ?>