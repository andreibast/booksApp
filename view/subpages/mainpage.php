<!--START MAIN CONTENT -->
<div class="container-fluid mb-5 col-md-10 homepage-main-container">
    <div class="row">
        <!--START LEFT SIDE CONTENT -->
        <?php include __DIR__.'/../../view/components/filters.php';?>
        <!--END LEFT SIDE CONTENT -->

        <!--START RIGHT SIDE CONTENT -->    
        <div class="col-md">
            
            <!--START ADD-TO-FAVORITES -->  
            <?php
                $for_favorites = "";
                if(isset($_SESSION['curent_username'])){
                    $current_user_name = $_SESSION['curent_username'];
                    if(isset($_GET['add_fav'])){
            
                        $current_user_id = $_SESSION['curent_user_id'];
                        $current_book_id = $_GET['add_fav'];

                        if($book_controller->checkFavorite($current_user_id, $current_book_id) == true){
                            $book_controller->addToFavorites($current_user_id, $current_book_id);
                            $for_favorites = "<p class= 'alert alert-success'>Added to fav's!<p>";
                        }else{
                            $for_favorites = "<p class= 'alert alert-warning'>Book is already added in your favorite list!<p>";
                        }
                    }
                }else{
                    if(isset($_GET['add_fav']) ){
                        $for_favorites = "<p class= 'alert alert-danger'>Please log in first!<p>";
                    }
                }
            ?>
            <!--END ADD-TO-FAVORITES -->

            <p class="text-center"><?php echo $for_favorites; ?></p>

            <!--START FILTERS --> 
            <div>  
                <?php
                    //searched cards
                    if(isset($_GET['search'])){
                        $searchKey = $_GET['search'];
                        foreach($book_controller->displaySearchedBooks($searchKey) as $book){
                            $givenPicturePath;
                            include __DIR__.'/../components/card_homepage.php';  
                        }  
                    }
                    //filtered cards
                    if(isset($_GET['category']) && !isset($_GET['search'])){
                        $categoryChecked = [];
                        $categoryChecked = $_GET['category'];

                        foreach($categoryChecked as $booksFiltered){
                            foreach($book_controller->displayFilteredBooks($booksFiltered) as $book){  
                                include __DIR__.'/../components/card_homepage.php'; 
                            }
                        }
                    }elseif(!isset($_GET['search'])){
                        foreach($book_controller->displayBooks() as $book){
                                include __DIR__.'/../components/card_homepage.php';
                        } 
                    } 
                ?>
            </div>
            <!--END FILTERS -->                  

        </div>
        <!--END RIGHT SIDE CONTENT -->   

    </div>
</div>
<!--END MAIN CONTENT -->