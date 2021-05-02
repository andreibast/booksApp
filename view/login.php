<div >
<div class="background-img login-height">
    
    <img  src="public/images/main/bffb7a55-1455-4a54-9b5a-028fb7e9f17a_200x200.png">
    <div class="login-form">
        <h1 class="mb-4">Please Login</h1>

        <?php  require_once(__DIR__.'/../controller/User.php');  ?>
        
        <?php

            if(isset($_SESSION['message_login'])): ?>

                <div class="alert alert-<?= $_SESSION['msg_type_login'] ?>">
                    <?php 
                        echo $_SESSION['message_login'];
                        unset($_SESSION['message_login']);
                        unset($_SESSION['key_login']);
                        session_destroy();
                    ?>
                </div>

        <?php endif ?>


        <form action="controller/User.php" method="POST" >
            <div class="form-group">
                <input type="email" name="login_email" class="form-control" placeholder="Email address" > 
            </div>
            <div class="form-group">
                <input type="password" name="login_password" class="form-control"  placeholder="Password" >
            </div>
            <input type="hidden" name="token_login" value="<?php echo $csrf_login; ?>">

            <button type="submit" name="login_user" class="btn btn-primary mb-4 col-md-12" >Login</button>
        </form>
        
        <a class="btn btn-warning" href="view/homepage.php">Enter as guest</a></label>
        <br><br>
        <a class="text-primary text-left" href="view/registration.php">Signup Now</a> <br>
        <a class="text-danger text-right" href="view/recover.php">Recover Password</a>
        
        <!-- <label class="form-check-label" for="exampleCheck1">Don't have an account?  -->
    </div>
    </div>
</div>
