<html>
<head>
<script src="../script/profilepic_checknotif.js"></script>
<title><?php
    if(isset($title) && !empty($title))
    {
        echo $title; 
    }
    else
    { 
        echo "Camagru"; 
	} ?></title>
	<?php if (isset($_SESSION['user_id'])) {
		if (isset($_SESSION['theme']))
		{
			if ($_SESSION['theme'] == 'Default')
				echo '<link rel="stylesheet" type="text/css" href="../extra_files/css/default.css" id="css2"/>';
			else if ($_SESSION['theme'] == 'cyan')
				echo '<link rel="stylesheet" type="text/css" href="../extra_files/css/cyan.css" id="css4"/>';
			else if ($_SESSION['theme'] == 'lavender')
				echo '<link rel="stylesheet" type="text/css" href="../extra_files/css/lavender.css" id="css5"/>';
		}
		?>
	<link rel="stylesheet" type="text/css" href="<?php echo "../extra_files/css/style.css";?>" id="css1"/>
	<?php }
	else {
		?>
	<link rel="stylesheet" type="text/css" href="<?php echo "../extra_files/css/style.css";?>" id="css1"/>
	<link rel="stylesheet" type="text/css" href="<?php echo "../extra_files/css/default.css";?>" id="css2"/>
	<?php
	}
	?>

    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.7.0/css/bulma.min.css"/>
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"/>
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.12/css/all.css" integrity="sha384-G0fIWCsCzJIMAVNQPfjH08cyYaUtMwjJwqiRKxxE/rx96Uroj1BtIQ6MLJuheaO9" crossorigin="anonymous">
</head>
<body>
<?php
if (isset($_SESSION['user_id']))
{
	$pdo = myPDO::getInstance();
	$query = "
		SELECT user_id, firstname, lastname, username, photo_profile_url FROM users
		WHERE user_id=:user_id
		";
	$sql = $pdo->prepare($query);
	$sql->execute(
			array(
				':user_id' => $_SESSION['user_id']
				)
			);
	$count = $sql->rowCount();
	if ($count > 0)
	{
	  $result = $sql->fetchAll();
	  foreach($result as $row)
		$login = $row['username'];
		$photo_profile_url = $row['photo_profile_url'];
	}
?>
	<header class="navbar-inverse navbar-fixed-top">
  		<div class="container-fluid">
    		<div class="navbar-header">
      			<a class="navbar-brand" href="ft_instagram.php"><div class="navbar-header">
      			<a class="navbar-brand" href='ft_instagram.php'><img src="../extra_files/images/cam_pic.gif" alt="Camagru" width="100" height="100"></a>
    		</div></a>
    		</div>
			<ul class="nav navbar-nav">
				
				<li><a href="home.php"><i class="fa fa-home"><?php echo ' '.$login?></i></a></li>
				
					<div class="dropdown">
						<a onclick="myFunction()"><img class="dropbtn" src='<?php echo $photo_profile_url?>' id="photo_profil_settings" draggable="false"></a>		
		  	</ul>
  		</div>
		  				<li>	  
							<div id="myDropdown" class="dropdown-content navbar-nav">
    							<a href="home.php"><i class="fa fa-home"></i> Home</a>
    							<a href="profile_b.php"><i class="fa fa-user-circle"></i> Profile</a> 
    							<a href="ft_instagram.php"><i class="fa fa-images"></i> Gallery</a>
								<a href="settings.php"><i class="fa fa-cog fa-spin" style="color:red"></i> Settings</a> 
								<a href="logout.php"><i class="fa fa-sign-out-alt"></i> Disconnect</a>
  							</div>
						</li>
					</div>
				</li>
	</header>
						
<?php
}
else
{ ?>
	<header class="navbar-inverse navbar-fixed-top">
  		<div class="container-fluid">
    		<div class="navbar-header">
      			<a class="navbar-brand" href='ft_instagram.php'><img src="../extra_files/images/cam_pic.gif" alt="Camagru" width="100" height="100"></a>
    		</div>
		<ul class="nav navbar-nav">
	  		<li><a href="login.php">Log in</a></li>
			<li><a href="register.php">Register</a></li>
    	</ul>
  		</div>
	</header>
<?php
}