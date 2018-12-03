<?php
require_once 'header.php';
require_once  '../actions/act_login.php';
?>
<section class="section login">
<div class="row">
    <div class="container">
        
        <div class="col-md-4 col-md-offset-4">
            <div class="row divform">
            <form  method="POST" id="loginform">
                    <h1><div style="text-align: center">
                        <img src="../extra_files/images/cam_pic.gif" draggable="false">
                    </div></h1>

                <div class="input-container">
                    <i class="fa fa-user icon"></i>
                    <input type="text" name="userlogin" value="" placeholder="Username or email" required>
                </div>
                <div class="input-container">
                    <i class="fa fa-key icon" style="font-size:20px;color:red"></i>
                    <input type="password" name="usrpasswd" value="" placeholder="Password" required>
                </div>
                
                <button type="submit">Log in</button>
            </form>
                <p class="center"><a href="reset_passwd.php">Forgot password?</a></p>
            </div>
            <div class="row divform">
                 <p class="center">Don't have an account? <a href="register.php" class="loginlink">Sign up</a></p>
            </div> 
        </div>
        <div class="col-md-3"></div>
    </div>
</div>
</section>


<?php
    require_once 'footer.php';
?>
