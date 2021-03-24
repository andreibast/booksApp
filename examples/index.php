<?php require_once 'process.php' ?>


<form  action="process.php" method="GET"  >
    <input type="hidden" name="id" value="<?php echo $id; ?>">
    <div class="form-group">
        <label >Modify Book Title</label>
        <input type="text" class="form-control" value="<?php echo  $title; ?>" name="edit_title" placeholder="Add Book Title">
    </div>
    <div class="form-group">
        <label >Modify Authors Names</label>
        <input type="text" class="form-control"  value="<?php echo  $authors; ?>" name="edit_authors" placeholder="Add Author(s) Name(s)">
    </div>


    <div class="form-row">
        <div class="form-group col-md-6">
        <label >Modify Category</label>
        <input type="text" class="form-control"  value="<?php echo  $category; ?>" name="edit_category" placeholder="Add Author(s) Name(s)">
        </div>
        <div class="form-group col-md-6">
        <label>Select Other Picture</label>
        <input type="file" class="form-control" value="<?php echo  $picture; ?>" name="edit_picture" >
        </div>
    </div>

    <div class="form-group">
        <label >Book Short Description</label>
        <textarea class="form-control" value="" name="edit_description" rows="3"><?php echo  $description; ?></textarea>
    </div>
    
    <button type="submit" name= "edit_book" class="btn btn-warning">Update Existing Book</button>
</form>


<table class="table table-striped text-center table-hover" >
    <thead >
        <tr> 
        <th scope="col"> <b>#</b></th>
        <th scope="col"> <b>Title</b></th>
        <th scope="col"> <b>Author</b></th>
        <th scope="col"> <b>Category</b></th>
        <th scope="col"> <b>Edit</b></th>
        <th scope="col"> <b>Delete</b></th>
        </tr>
    </thead>
    <tbody>


<?php 
    
    $conn = mysqli_connect("localhost","root","","books.app"); 
    $result = mysqli_query($conn,"select * from books");

    while($user_row = mysqli_fetch_row($result)) {  ?>
        
        <tr>
            <td scope="row"><?php echo $user_row[0];  ?></td>
            <td><?php echo $user_row[1];  ?></td>
            <td><?php echo $user_row[2];  ?></td>
            <td><?php echo $user_row[3];  ?></td>
            <td><a href="http://localhost/books.andreibasturescu/examples/index.php?admin_edit=<?php echo $user_row[0];  ?>"><i class="far fa-edit"></i>1</a>  </td>
            
                    

        </tr>


<?php  }  ?>