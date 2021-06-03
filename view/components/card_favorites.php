<?php 
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


