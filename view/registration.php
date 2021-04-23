
    <?php include("layout.css.php"); ?>
<div class="background-img login-height">
        <img src="../../public/images/main/bffb7a55-1455-4a54-9b5a-028fb7e9f17a_200x200.png">
        <div class="login-form">
            <h1 class="mb-4">Registration Form</h1>
            
            

            
            <?php  require_once(__DIR__.'/../controller/users/RegisterUser.php');  ?>
           
            <?php

                if(isset($_SESSION['message_register'])): ?>

                    <div class="alert alert-<?= $_SESSION['msg_type_register'] ?>">
                        <?php 
                            echo $_SESSION['message_register'];
                            unset($_SESSION['message_register']);
                            unset($_SESSION['key']);
                            session_destroy();
                        ?>
                    </div>

                <?php endif ?>
              
            <form action="../controller/users/RegisterUser.php" method="POST" >
                <div class="form-group">
                    <input type="text" class="form-control" name="new_surname" placeholder="Surname" >
                </div>
                <div class="form-group">
                    <input type="email" class="form-control" name="new_email" placeholder="Email address" >
                </div>
                <div class="form-group">
                    <input type="password" class="form-control"  name="new_password" placeholder="Enter Password" required>
                </div>
                <div class="form-group">
                    <input type="password" class="form-control" name="new_password_check" placeholder="Repeat Password" required>
                </div>

                <input type="hidden" name="token" value="<?php echo $csrf; ?>">


                <button type="submit" name="new_user" class="btn btn-danger mb-4 col-md-12">Create new account</button>
            </form>

            <label><a href="../">Go Back To Login Page</a></label>
        </div>
    </div>

    <?php include("layout.js.php"); ?>
