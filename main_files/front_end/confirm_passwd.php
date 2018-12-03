<?php
require_once '../actions/act_confirm_passwd.php';
require_once 'header.php';
?>
<!DOCTYPE html>
<html>
<head>
    <title>Confirm Password</title>
</head>
<body>

	<section class="section login">
		<div class="row">
			<div class="container">
				<div class="forgot_form">
					<div class="row divform center">
					<form method="POST" id="loginform">
						<div class="input-container">
                 	  		 <i class="fa fa-key icon"></i>
							 <input type="password" name="new_passwd" value="" placeholder="New password" required>
						</div>
						<div class="input-container">
                	    	<i class="fa fa-key icon" style="font-size:20px;color:red"></i>
							<input type="password" name="conf_passwd" value="" placeholder="Confirm Password" required>
               		 	</div>
						<button style="border-radius:50px; width:15%;" type="submit" name="submit">Reset</button>
					</form>
					</div>
				</div>
			</div>
		</div>
	</section>

<?php
	require_once 'footer.php';
?>   
</body>
</html>





