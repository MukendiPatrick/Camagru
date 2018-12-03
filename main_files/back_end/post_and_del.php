<?php
require_once '../set_conf/session_start.php';

if (isset($_POST['publish']))
{
    $file = htmlspecialchars($_POST['publish']);
    $time = time();
    $pdo = myPDO::getInstance();
    $query = "
        INSERT INTO `instagram` (`image_url`, `user_id`, `date_time_photo`, likes, comments, flag)
        VALUES (:image_url, :user_id, :date_time_photo, :likes, :comments, :flag)
        ";
    $sql = $pdo->prepare($query);
    $sql->execute(
        array(
            ':image_url'       => $file,
            ':user_id'         => $_SESSION["user_id"],
            ':date_time_photo' => $time,
            ':likes'           => 0,
            ':comments'        => 0,
            ':flag'            => -10
            )
        );
    $count_image = $sql->rowCount();
    if ($count_image > 0)
    {
        $arr = ["success" => "Your photo has been posted"];
        echo json_encode($arr);
    }
}
else if (isset($_POST['cancel']))
{
    $file = $_POST['cancel'];
    if (file_exists($file))
    {
        unlink($file);
        $arr = ["success" => "Your photo has not been posted"];
        echo json_encode($arr);
    }
        
}