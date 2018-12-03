<?php ini_set('display_errors', 'On');

require_once  '../class/mypdo.class.php';

if (!isset($_GET['log']) || !isset($_GET['key']))
{
	
	header('location: ../front_end/register.php');
}
else
{
	$pdo = myPDO::getInstance();

	$login = htmlspecialchars($_GET['log']);
	$key = htmlspecialchars($_GET['key']);
	$sql = $pdo->prepare("SELECT user_id FROM users WHERE username=:username AND user_reset_passwd_code=:user_reset_passwd_code");
	$sql->execute(
		array(
			':username'             => $login,
			':user_reset_passwd_code' => $key,
		)
	);
	$sql->execute();
	$count_row = $sql->rowCount();
	if ($count_row > 0)
	{
		if (isset($_POST['submit']))
		{
			if (isset($_POST['new_passwd']))
			{

				$values = [
					'new_passwd'	=> htmlspecialchars($_POST['new_passwd']),
					'conf_passwd'	=> htmlspecialchars($_POST['conf_passwd'])
				];

				$error = [];
				if (empty($values['new_passwd']) || empty($values['conf_passwd'])){
					$error['passwd'] = "Wrong new password! Your password must contain at least 1 number, 1 lowercase and 1 upper case letter";
				}

				if (!empty($values['new_passwd']))
				{
					if (!preg_match('/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,20}$/', $values['new_passwd']))
						$error['passwd'] = "Wrong new password! Your password must contain at least 1 number, 1 lowercase and 1 upper case letter";
					if (!preg_match('/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,20}$/', $values['conf_passwd']) || empty($values['conf_passwd']))
						$error['passwd'] = "Wrong confirm password! Your password must contain at least 1 number, 1 lowercase and 1 upper case letter";
					if ($values['new_passwd'] != $values['conf_passwd'])
						$error['passwd'] = "New password and confirm password are different. ";

				}

				if (!empty($values['conf_passwd']) && empty($values['new_passwd']))
					$error['passwd'] = "Empty new password. ";

				if (empty($error))
				{
					$passwd = hash('whirlpool', $values['new_passwd']);
					$sql = $pdo->prepare("UPDATE users SET passwd=:passwd, user_reset_passwd_code=:user_reset_passwd_code  WHERE username=:username");
					$sql->execute(
						array(
							':passwd'                    => $passwd,
							':user_reset_passwd_code'    => md5(rand()),
							':username'                  => $login
						)
					);

					?>
					<div class="alert alert-success">
						<a class="close" aria-label="close">&times;</a>
						<p>You have successfully changed your password</p>
					</div>
					<?php
					header ('location: ../front_end/login.php');
				}
				else
				{?>
					<div class="alert alert-danger">
						<a class="close" aria-label="close">&times;</a>
					<?php 
					foreach($error as $value)
						echo "Error: " . $value ?>
						<a href="../front_end/confirm_passwd.php?log=<?php echo $_GET['log'] ?>&key=<?php echo $_GET['key'] ?>">Try again!</a>
					</div>
					<?php
				}
			}
		}
	}
	else
	{
		header ('location: ../front_end/register.php');
	}
}
?>
