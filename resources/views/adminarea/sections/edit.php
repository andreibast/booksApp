    <div class="row mt-3">
        <div class="card-header text-center col-md-11 mb-2 rounded-pill admin-section-common ">
            <h2>Edit Book</h2>
        </div>
   </div>
    <div class="row">
        <div class="card col-md-11 mt-3 mb-2 p-5 admin-section-common">
            <div class="card-body text-center admin-section-common-card-body">
            
            
            <?php  require_once '../../../Http/Controllers/admin/EditBook.php' ?>


            <?php if(isset($_SESSION['message'])): ?>
                <div class="alert alert-<?= $_SESSION['msg_type'] ?>">
                    <?php 
                        echo $_SESSION['message'];
                        unset($_SESSION['message']);
                    ?>
                </div>
            <?php endif ?>

               
            <form  action="../../../Http/Controllers/admin/EditBook.php" method="POST" enctype="multipart/form-data"  >
                <input type="hidden" name="id" value="<?php echo $editBook->id; ?>">
                <div class="form-group">
                    <label >Modify Book Title</label>
                    <input type="text" class="form-control" value="<?php echo  $editBook->title; ?>" name="edit_title" placeholder="Add Book Title">
                </div>
                <div class="form-group">
                    <label >Modify Authors Names</label>
                    <input type="text" class="form-control"  value="<?php echo  $editBook->authors; ?>" name="edit_authors" placeholder="Add Author(s) Name(s)">
                </div>
                <div class="form-group">
                    <b>Current Assigned Cover Picture</b><br>
                    <a href="<?php echo $givenPicturePath . $editBook->picture; ?>"><img src="<?php echo $givenPicturePath . $editBook->picture; ?>" style="height: 212px; width:150px;" ></a>
                </div>


                <div class="form-row">
                    <div class="form-group col-md-6">
                    <label >Modify Category</label>
                    <input type="text" class="form-control"  value="<?php echo  $editBook->category; ?>" name="edit_category" placeholder="Add Author(s) Name(s)">
                    </div>
                    <div class="form-group col-md-6">
                    <label>Select Another Picture Or Leave Blank</label>
                    <input type="file" class="form-control" value="" name="edit_picture" >
                    </div>
                </div>

                <div class="form-group">
                    <label >Book Short Description</label>
                    <textarea class="form-control" value="" name="edit_description" rows="3"><?php echo  $editBook->description; ?></textarea>
                </div>
                
                <button type="submit" name= "edit_book" class="btn btn-warning">Update Existing Book</button>
            </form>

            </div>
            <a href="admin.php?admin_manage=Manage+Books&admin_edit=Edit+Book" class="text-right">See all books-></a>
        </div>
        
    </div>
