<?php include("../templates/layout.css.php"); ?>
<?php  require_once '../../controller/User.php';  ?>
<?php
    $current_user_name="Guest";
    if(isset($_SESSION['curent_username'])){
        $current_user_name = $_SESSION['curent_username'];
    }
?>
<div class="container-fluid ">
    <div class="row admin-section-page-size">

        <div class="bg-dark text-light text-center admin-section-sidebar col-md-2">
            <h1 class="pt-5">Admin Page</h1>
            <h6 class="mt-5" >Welcome <a href=""><?php echo  $current_user_name;  ?></a></h6>

            <form action="" method="get">
                <input type="submit" name="admin_dashboard" value="Dashboard" class="btn btn-light admin-section-btn-item col-md-12">
                <input type="submit" name="admin_add_new" value="Add New Book" class="btn btn-light admin-section-btn-item col-md-12">
                <input type="submit" name="admin_manage" value="Manage Books" class="btn btn-light admin-section-btn-item col-md-12">
                <input type="hidden" name="admin_edit" value="Edit Book" class="">
            </form>

            <div>
                <a href="../homepage.php" class="text-decoration-none text-light btn btn-danger admin-section-btn-exit col-md-12">Exit Admin Section</a>
            </div>
        </div>

        <div class="col-md-10 admin-section-right-container">
            <?php 
                if(isset($_GET['admin_dashboard'])){
                    include("sections/dashboard.php");
                }elseif(isset($_GET['admin_add_new'])){
                    include("sections/add_new.php");
                }elseif(isset($_GET['admin_manage'])){
                    include("sections/manage_books.php");
                }elseif(isset($_GET['admin_edit'])){
                    include("sections/edit.php");
                };
            ?>
        </div>

    </div>
</div>
<?php include("../templates/layout.js.php"); ?>