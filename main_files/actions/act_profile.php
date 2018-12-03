<?php ini_set('display_errors', 'On');

require_once  '../class/mypdo.class.php';

$title = 'Profile Page';
$js_source = ['../script/profilepic_checknotif.js', '../script/ft_settings.js'];

session_start();

if (isset($_SESSION['user_id']))
{
    echo '<div id="alert"></div>';
  $pdo = myPDO::getInstance();
  $query = "
      SELECT user_id, firstname, lastname, username, notif_comment, photo_profile_url, theme, email FROM users
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
    {
      $fname = $row['firstname'];
      $lname = $row['lastname'];
      $login = $row['username'];
      $notif = $row['notif_comment'];
      $photo_profile_url = $row['photo_profile_url'];
      $theme = $row['theme'];
      $email = $row['email'];
    }
    
  }
}
else
  header ('location: ../front_end/login.php');
?>
