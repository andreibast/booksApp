<?php 
    $givenPicturePath;
    if(strcmp($book['picture'], '150x212.png') == 0){
        $givenPicturePath = "../public/images/";
    }else{
        $givenPicturePath = '../public/images/user_books_covers/';
    }
?>
<!--START CARD --> 
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
<!--START CARD --> 