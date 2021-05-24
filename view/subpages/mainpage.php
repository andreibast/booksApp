<!--START MAIN CONTENT -->
<div class="container-fluid mb-5 col-md-10 homepage-main-container">
    <div class="row">
        <!--START LEFT SIDE CONTENT -->
        <div class="accordion col-md-3" id="accordionExample">

            <?php $searchKey = "";  ?>

            <!--START SEARCHBAR -->
            <form class="form-inline align-right mb-4" style="background:white;" action="" method="GET">
                <input class="form-control col-md-8" type="search" name="search" placeholder="Search Title" value="<?= $searchKey; ?>">
                <button class="btn btn-outline-success my-2 my-sm-0 col-md-4" type="submit">Search</button>
            </form>
            <!--END SEARCHBAR -->

            <!--START CHECKBOX FILTERS -->
            <div class="card">
                <div class="card-header" id="headingOne">
                    <h2 class="mb-0">
                        <button class="btn btn-link btn-block text-left text-dark" type="button" data-toggle="collapse" data-target="#checkboxFilters" aria-expanded="true" aria-controls="checkboxFilters">
                        <strong>Filter</strong> 
                        </button>
                    </h2>
                </div>
            
                <div id="checkboxFilters" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
                    <div class="card-body">
                        <form action="" method="GET">
                            <?php
                                $obj = new Book();
                                foreach($obj->displayCategories() as $result){ 
                                    $checked = []; //where data is kept
                                    if(isset($_GET['category'])){
                                        $checked = $_GET['category'];
                                    }
                                    ?>
                                        <div>
                                            <input type="checkbox" name="category[]" value="<?php echo $result['category']; ?>"
                                                <?php if(in_array($result['category'], $checked)) {echo 'checked'; } ?>
                                            >
                                            <?php echo $result['category'] ?>
                                        </div>
                                    <?php
                                }
                                unset($obj); 
                            ?>
                            <button type="submit" class="btn btn-light mt-3 col-md-12">Apply Filter</button>
                        </form>
                    </div>
                </div>
            </div>
            <!--END CHECKBOX FILTERS -->
        </div>
        <!--END LEFT SIDE CONTENT -->

        <!--START RIGHT SIDE CONTENT -->    
        <div class="col-md">
            
            <!--START ADD-TO-FAVORITES -->  
            <?php
                $obj = new Book();
                $for_favorites = "";
                if(isset($_SESSION['curent_username'])){
                    $current_user_name = $_SESSION['curent_username'];
                    if(isset($_GET['add_fav'])){
            
                        $current_user_id = $_SESSION['curent_user_id'];
                        $current_book_id = $_GET['add_fav'];

                        if($obj->checkFavorite($current_user_id, $current_book_id) == true){
                            $obj->addToFavorites($current_user_id, $current_book_id);
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
                unset($obj); 
            ?>
            <p class="text-center"><?php echo $for_favorites; ?></p>
            <!--END ADD-TO-FAVORITES -->

            <!--START SEARCHED CARD -->  
            <?php
                $obj = new Book();
                if(isset($_GET['search'])){
                    $searchKey = $_GET['search'];
                    
                    foreach($obj->displaySearchedBooks($searchKey) as $searchedBook){
                        $givenPicturePath;
                        if(strcmp($searchedBook['picture'], '150x212.png') == 0){
                            $givenPicturePath = "../public/images/";
                        }else{
                            $givenPicturePath = '../public/images/user_books_covers/';
                        }
                        ?>

                        <!--START CARDS -->  
                        <div class="card col-md-12 mb-4 mr-2 homepage-card-container">
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
                                            <a href="homepage.php?add_fav=<?php echo $searchedBook['id']?>" class="btn btn-success mt-2">Add</a>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--END CARDS --> 
                <?php 
                    }  
                }
                unset($obj); 
            ?>
            <!--END SEARCHED CARD -->  

            <!--START FILTERED CARD -->
            <div>  
                <?php  
                    $obj = new Book();
                    if(isset($_GET['category']) && !isset($_GET['search'])){
                        $categoryChecked = [];
                        $categoryChecked = $_GET['category'];

                        foreach($categoryChecked as $booksFiltered){

                            foreach($obj->displayFilteredBooks($booksFiltered) as $book){
                                $givenPicturePath;
                                if(strcmp($book['picture'], '150x212.png') == 0){
                                    $givenPicturePath = "../public/images/";
                                }else{
                                    $givenPicturePath = '../public/images/user_books_covers/';
                                }
                ?>
                                <!--START CARDS --> 
                                <div class="card col-md-12 mb-4 mr-2 homepage-card-container">
                                    <div class="card-body homepage-card-body">
                                        <div class="container">
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <img src="<?php echo $givenPicturePath . $book['picture']; ?>"  class="homepage-card-cover"> 
                                                </div>
                                                <div class="col-md-7 ml-3">
                                                        <h2 class="card-title"><?php echo $book['title'];  ?></h2>
                                                        <h5 class="card-title"><?php  echo $book['authors']; ?></h5>
                                                        <h6 class="card-title"><?php  echo $book['category']; ?></h6>
                                                        <p class="card-text" ><?php echo $book['description'];  ?></p>
                                                </div>
                                                <div class="col-md-1">
                                                    <a href="homepage.php?add_fav=<?php echo $book['id']; ?>" class="btn btn-success mt-2" >Add</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!--END CARDS --> 
                <?php
                            }
                        }
                    }elseif(!isset($_GET['search'])){
                        foreach($obj->displayBooks() as $book){

                            $givenPicturePath;
                            if(strcmp($book['picture'], '150x212.png') == 0){
                                $givenPicturePath = "../public/images/";
                            }else{
                                $givenPicturePath = '../public/images/user_books_covers/';
                            }
                ?>
                            <!--START CARDS --> 
                            <div class="card col-md-12 mb-4 mr-2 homepage-card-container">
                                <div class="card-body homepage-card-body">
                                    <div class="container">
                                        <div class="row">
                                            <div class="col-md-3">
                                                <img src="<?php echo $givenPicturePath . $book['picture']; ?>"  class="homepage-card-cover"> 
                                            </div>
                                            <div class="col-md-7 ml-3">
                                                    <h2 class="card-title"><?php echo $book['title'];  ?></h2>
                                                    <h5 class="card-title"><?php  echo $book['authors']; ?></h5>
                                                    <h6 class="card-title"><?php  echo $book['category']; ?></h6>
                                                    <p class="card-text" ><?php echo $book['description'];  ?></p>
                                            </div>
                                            <div class="col-md-1">
                                                <a href="homepage.php?add_fav=<?php echo $book['id']; ?>" class="btn btn-success mt-2" >Add</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--START CARDS --> 

                <?php } } unset($obj); ?>
            </div>
            <!--END FILTERED CARD -->                  

        </div>
        <!--END RIGHT SIDE CONTENT -->   

    </div>
</div>
<!--END MAIN CONTENT -->