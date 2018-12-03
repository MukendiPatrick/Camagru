<?php
require_once '../set_conf/session_start.php';
if ($_POST['imageId']) {
    if (isset($_SESSION['user_id']))
    {
        $pdo = myPDO::getInstance();
        if ($_POST['imageId'])
        {
            $query = "
            
            SELECT  likes, user_id, flag 
            FROM instagram
            WHERE image_id=:image_id
            ";
            $sql = $pdo->prepare($query);
            $sql->execute(
                array(
                    ':image_id' => $_POST['imageId']
                )
            );
            $count = $sql->rowCount();
            if ($count > 0)
            {
                $result = $sql->fetchAll();
                foreach($result as $row)
                {
                    $like = $row['likes'];
                    $flag = $row['flag'];
                    if ($flag != $_SESSION['user_id'])
                    {
                        $like += 1;
                        $flag = $_SESSION['user_id'];
                    }
                    else
                    {
                        $like -= 1;
                        $flag = -10;
                    }
                    $query = "
                        UPDATE instagram SET likes=:likes, flag=:flag WHERE image_id=:image_id;
                    ";
                    $sql = $pdo->prepare($query);
                    $sql->execute(
                        array(
                            ':likes'     => $like,
                            ':flag'     => $flag,
                            ':image_id'     => $_POST['imageId']
                        )
                    );
                }
            }
        }
    }
    else
    {
        $arr = ["error" => "You need to sign in or sign up before continuing."];
        echo json_encode($arr);
    }  
}
?>
