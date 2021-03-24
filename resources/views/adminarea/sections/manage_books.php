<?php require_once '../../../Http/Controllers/admin/DeleteBook.php';  ?>

<style>

.table-hover tbody tr:hover td, .table-hover tbody tr:hover th {
  background-color: #d1d2d4;
}
</style>

<div class="row mt-3">
        <div class="card-header text-center col-md-11 mb-2 rounded-pill admin-section-common ">
            <h2>Manage Books</h2>
        </div>
   </div>
    <div class="row">
        <div class="card col-md-11 mt-3 mb-2 p-5 admin-section-common">
            <div class="card-body text-center admin-section-common-card-body">
            <h2 class="mb-5">All Books</h2>
            


<?php  

    if(isset($_SESSION['message'])): ?>

        <div class="alert alert-<?= $_SESSION['msg_type'] ?>">
            <?php 
                echo $_SESSION['message'];
                unset($_SESSION['message']);
            
            ?>
        </div>

<?php endif ?>

<table class="table table-striped text-center table-hover" >
    <thead >
        <tr> 
        <th scope="col"> <b>#</b></th>
        <th scope="col"> <b>Cover</b></th>
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

                <?php
                $givenPicturePath;
                    if(strcmp($user_row[4], '150x212.png') == 0){
                        $givenPicturePath = "../../../public/images/";
                    }else{
                        $givenPicturePath = '../../../public/images/user_books_covers/';
                    }
                ?>
            
            <tr>
                <td scope="row"><?php echo $user_row[0];  ?></td>
                <td> <a href="<?php echo $givenPicturePath . $user_row[4]; ?>"><img src="<?php echo $givenPicturePath . $user_row[4]; ?>" class="admin-section-table-row-cover"></a></td>
                <td><?php echo $user_row[1]; ?></td>
                <td><?php echo $user_row[2]; ?></td>
                <td><?php echo $user_row[3]; ?></td>

                
            

                <td><a href="../../../resources/views/adminarea/admin.php?admin_edit=<?php echo $user_row[0]; ?>"><i class="far fa-edit"></i></a>  </td>
                
                <td >
                    <a data-id="<?php echo $user_row[0]; ?>"   data-link ="<?php echo "../" . $user_row[4]; ?>" onclick="getLink(this); confirmDelete(this);" class="admin-section-table-row-hover-delete"><i class="far fa-trash-alt text-danger"></i></a>

                </td>
            </tr>
        <?php  }  ?>
        
        <div class="modal" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Delete Book</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <div class="modal-body">
                        Are you sure you want to delete this book?
                        <form action="../../../Http/Controllers/admin/DeleteBook.php" id="form-delete-user" method="POST">
                            <input type="hidden" name="picturePath" class="col-md-2">
                            <input type="hidden" name="id" class="col-md-2">
                        </form>


                    </div>


                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        <button type="submit" form="form-delete-user" class="btn btn-danger" name="delete">Delete Book</button>
                    </div>
                </div>
            </div>
        </div>

        <script>

            function getLink(self){
                var picturePath = self.getAttribute("data-link");
                document.getElementById("form-delete-user").picturePath.value = picturePath;
            }

            function confirmDelete(self){
                var id = self.getAttribute("data-id");
                document.getElementById("form-delete-user").id.value = id;
                $("#exampleModal").modal("show");
            }
            
        </script>
        <?php  mysqli_close($conn); ?>
    </tbody>
</table>

            <a href="admin.php?admin_add_new=Add+New+Book&admin_edit=Edit+Book"><button type="button" class="btn btn-primary col-md-3">Add New Book</button></a>

            </div>
        </div>
    </div>
