
<?php  //require_once __DIR__.'/../../controller/User.php';  ?>
<?php  //require_once __DIR__.'/../../controller/Book.php';  ?>
<?php
    // ob_start();
    $current_user_name="Guest";

    if(isset($_SESSION['curent_username'])){
        $current_user_name = $_SESSION['curent_username'];
    }

    // require_once __DIR__."/../../view/homepage.php";
    // require_once  __DIR__.'/../../lib/Database.php';
    // require_once  __DIR__.'/../../controller/Book.php';

    // $db = new Database();
    // $book_model = new Books($db);
    // $book_controller = new Book($book_model);
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

                //to remove fav
                if(isset($_GET['remove_favs'])){
                    $current_del_book = $_GET['remove_favs'];
                    $book_controller->deleteFavoriteBook($current_del_book);
                    header("location: ../homepage.php?favorite_page=Favorite+books");
                    echo "book has been removed from favorites";
                }

                foreach($book_controller->displayFavoriteBooks($current_user_id) as $searchedBook){
                    include __DIR__.'/../components/card_favorites.php';
                }
            ?>
        </div>
        <!--END RIGHT-SIDE CONTENT -->
                
    </div>
</div>
<!--END MAIN CONTENT -->