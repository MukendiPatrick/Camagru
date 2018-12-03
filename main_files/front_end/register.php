<?php
require_once 'header.php';
require_once  '../actions/act_register.php';
?>
<section class="section register">
    
    <div class="row">
        <div class="container">
            
            <div class="col-md-4 col-md-offset-4">
                <div class="row divform"> 
                <form method="POST"  id="registerform" >
                    <h1><div style="text-align: center">
                        <img src="../extra_files/images/cam_pic.gif" draggable="false">
                    </div></h1>

                    <div class="input-container">
                        <i class="fa fa-user icon"></i>
                        <input type="text" name="fname" value="" placeholder="First name" pattern="^[a-zA-Z]+$" required>
                    </div> 
                    <div class="input-container">
                        <i class="fa fa-user icon"></i>
                        <input type="text" name="lname" value="" placeholder="Last Name" pattern="^[a-zA-Z]+$" required>
                    </div>
                    <div class="input-container">
                        <i class="fa fa-envelope icon"></i>
                        <input type="email" name="useremail" value="" placeholder="Email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$" required>
                    </div>
                    <div class="input-container">
                        <i class="fa fa-user icon"></i>
                        <input type="text" name="username" value="" placeholder="Username" pattern="^[a-zA-Z0-9_]+$" required>
                    </div>
                    <div class="input-container">
                         <i class="fa fa-key icon" style="font-size:20px;color:red"></i>
                         <input type="password" name="usrpasswd" value="" placeholder="Password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,20}" required>
                     </div>
                    <button type="submit" name="submit" value="OK">Sign up</button>
                </form>
                </div>
                <div class="row divform">
                     <p class="center">Have an account? <a href="login.php" class="loginlink">Log in</a></p>
                </div> 
            </div>
            <div class="col-md-2"></div>
        </div>
    </div>
</section>

<?php
    require_once 'footer.php';
?>