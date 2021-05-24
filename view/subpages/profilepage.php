
<?php  require_once __DIR__.'/../../controller/User.php';  ?>
<?php  require_once __DIR__.'/../../controller/Book.php';  ?>
<?php
    ob_start();
    $current_user_name="Guest";

    if(isset($_SESSION['curent_username'])){
        $current_user_name = $_SESSION['curent_username'];
    }
?>
<!--START MAIN CONTENT -->
<div class="container-fluid">
    <div class="row">

        <!--START LEFT-SIDE CONTENT -->
        <div class="bg-light text-dark text-center admin-section-sidebar col-md-2">
            <h1 class="pt-5">My Profile</h1>
            <img src="../public/images/main/profile_default_image.jpg" class="rounded-circle profilepage-image mt-3 mb-3">
            <h6 class="mt-2 "><a href=""><?php echo $current_user_name ?></a></h6>
        </div>
        <!--END LEFT-SIDE CONTENT -->
        

        <!--START RIGHT-SIDE CONTENT -->
        <div class="col-md">

            <div class="card-header text-center col-md-11 mt-3 mb-3 rounded-pill admin-section-common ">
                <h2>Favorite Books</h2>
            </div>

            <!-- main section card -->
            <?php  
                $current_user_id = $_SESSION['curent_user_id']; 
                $obj = new Book();

                //to remove fav
                if(isset($_GET['remove_favs'])){
                    $current_del_book = $_GET['remove_favs'];
                    $obj->deleteFavoriteBook($current_del_book);
                    header("location: ../homepage.php?favorite_page=Favorite+books");
                    echo "book has been removed from favorites";
                }

                foreach($obj->displayFavoriteBooks($current_user_id) as $searchedBook):
                    $givenPicturePath;
                    if(strcmp($searchedBook['picture'], '150x212.png') == 0){
                        $givenPicturePath = "../public/images/";
                    }else{
                        $givenPicturePath = '../public/images/user_books_covers/';
                    }
            ?>
                    <!--START CARD -->
                    <div class="card col-md-11 mb-4 homepage-card-container">
                        <div class="card-body homepage-card-body">
                            <div class="container">
                                <div class="row">
                                    <div class="col-md-3">
                                        <img src="<?php echo $givenPicturePath . $searchedBook['picture']; ?>"  class="homepage-card-cover"> 
                                    </div>
                                    <div class="col-md-7 ml-3">
                                        <h2 class="card-title"><?php echo $searchedBook['title'];  ?></h2>
                                        <h5 class="card-title"><?php  echo $searchedBook['authors'];  ?></h5>
                                        <h6 class="card-title" ><?php echo $searchedBook['category'];   ?></h6>
                                        <p class="card-text" class="homepage-card-description"><?php echo $searchedBook['description'];  ?></p>
                                    </div>
                                    <div class="col-md-1">
                                        <a href="subpages/profilepage.php?remove_favs=<?php echo $searchedBook['id']; ?>" class="btn btn-danger mt-2" >Remove</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--END CARD -->
            <?php 
                endforeach; 
                unset($obj); 
            ?>
        </div>
        <!--END RIGHT-SIDE CONTENT -->
                
    </div>
</div>
<!--END MAIN CONTENT -->