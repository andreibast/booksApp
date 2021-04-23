<?php require_once '../../controller/Book.php';  ?>

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
        
        $obj = new Book();
        
        foreach($obj->displayBooks() as $book){ ?>

            <?php
                $givenPicturePath;
                if(strcmp($book['picture'], '150x212.png') == 0){
                    $givenPicturePath = "../../public/images/";
                }else{
                    $givenPicturePath = '../../public/images/user_books_covers/';
                }
            ?>
            
            <tr>
                <td scope="row"><?php echo $book['id'];  ?></td>
                <td> <a href="<?php echo $givenPicturePath . $book['picture']; ?>"><img src="<?php echo $givenPicturePath . $book['picture']; ?>" class="admin-section-table-row-cover"></a></td>
                <td><?php echo $book['title']; ?></td>
                <td><?php echo $book['authors']; ?></td>
                <td><?php echo $book['category']; ?></td>

                <td><a href="../../view/adminarea/admin.php?admin_edit=<?php echo $book['id']; ?>"><i class="far fa-edit"></i></a>  </td>
                
                <td >
                    <a data-id="<?php echo $book['id']; ?>"   data-link ="<?php echo "../" . $book['picture']; ?>" onclick="getLink(this); confirmDelete(this);" class="admin-section-table-row-hover-delete"><i class="far fa-trash-alt text-danger"></i></a>

                </td>
            </tr>
        <?php unset($obj); }  ?>
        
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
                        <form action="../../controller/Book.php" id="form-delete-user" method="POST">
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
    </tbody>
</table>

            <a href="admin.php?admin_add_new=Add+New+Book&admin_edit=Edit+Book"><button type="button" class="btn btn-primary col-md-3">Add New Book</button></a>

            </div>
        </div>
    </div>
