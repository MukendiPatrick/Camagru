<?php
require_once '../actions/act_reset_passwd.php';
require_once 'header.php';
?>
<section class="section reset">
<div class="row">
    <div class="container">
        <div class="forgot_form">
            <div class="row divform">
            <form  method="POST" id="reset_form">
                <p> We can help you reset your password using the email address linked to your account</p>
                        <i class="fa fa-envelope icon"></i>
                        <input type="email" name="email" value="" placeholder="Your email" required>
                <button style="border-radius:50px; width:1%;" type="submit" name="submit" value="OK">Submit</button>
            </form>
            </div>
        </div>
    </div>
</div>
</section>
<?php 
    require_once 'footer.php';
?>