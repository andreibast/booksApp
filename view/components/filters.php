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
                        
                        foreach($book_controller->displayCategories() as $result){ 
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
                    ?>
                    <button type="submit" class="btn btn-light mt-3 col-md-12">Apply Filter</button>
                </form>
            </div>
        </div>
    </div>
    <!--END CHECKBOX FILTERS -->
</div>