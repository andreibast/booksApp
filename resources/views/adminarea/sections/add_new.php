   <div class="row mt-3">
        <div class="card-header text-center col-md-11 mb-2 rounded-pill admin-section-common ">
            <h2>Add New Book</h2>
        </div>
   </div>
  
    <div class="row">
        <div class="card col-md-11 mt-3 mb-2 p-5 admin-section-common"  >
            <div class="card-body text-center admin-section-common-card-body">
           
                <?php  require_once __DIR__.'/../../../../Http/Controllers/admin/AddBook.php' ?>
            
                <?php

                if(isset($_SESSION['message'])): ?>

                    <div class="alert alert-<?= $_SESSION['msg_type'] ?>">
                        <?php 
                            echo $_SESSION['message'];
                            unset($_SESSION['message']);

                        ?>
                    </div>
                <?php endif ?>

   
                <form  action="../../../Http/Controllers/admin/AddBook.php" method="POST" enctype="multipart/form-data" >
                    <div class="form-group">
                        <label >Add Book Title</label>
                        <input type="text" class="form-control"  name="add_title" placeholder="Add Book Title">
                    </div>
                    <div class="form-group">
                        <label >Add Authors Names</label>
                        <input type="text" class="form-control"  name="add_authors" placeholder="Add Author(s) Name(s)">
                    </div>


                    <div class="form-row">
                        <div class="form-group col-md-6">
                        <label >Add Category</label>
                        <input type="text" class="form-control"   name="add_category" placeholder="Add Author(s) Name(s)">
                        </div>
                        <div class="form-group col-md-6">
                        <label>Add a Picture (150x212) or leave blank</label>
                        <input type="file" class="form-control" name="add_picture" >
                        </div>
                    </div>

                    <div class="form-group">
                        <label >Add Book Short Description</label>
                        <textarea class="form-control"  name="add_description" rows="3"></textarea>
                    </div>
                    
                    <button type="submit" name= "add_book" class="btn btn-primary">Add Book</button>
                </form>
           
            </div>
            <a href="admin.php?admin_manage=Manage+Books&admin_edit=Edit+Book" class="text-right">See all books-></a>
        </div>
        

    </div>
