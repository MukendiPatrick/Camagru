<?php

require_once  '../class/mypdo.class.php';

$title = 'Reset_passwd';

if (isset($_POST['submit']))
{
    if (isset($_POST['email']))
    {

        $values = [
            'email' => htmlspecialchars($_POST['email']),
        ];

        $error = [];

        if (!filter_var($values['email'], FILTER_VALIDATE_EMAIL) || empty($values['email'])){
            $error['email'] = "Invalid email!";
        }

        $pdo = myPDO::getInstance();
        $query = "
            SELECT user_id, email, username, firstname FROM users
            WHERE email=:user_email
        ";
        $sql = $pdo->prepare($query);
        $sql->execute(
            array(
              ':user_email' => htmlspecialchars($values['email'])
            )
        );
        $count = $sql->rowCount();
        if ($count > 0)
        {
            $user_reset_passwd_code = md5(rand());
            $result = $sql->fetchAll();
            foreach ($result as $row)
            {
                $email = $row['email'];
                $login = $row['username'];
                $firstname = $row['firstname'];
                $dest = $email;
                $sql = $pdo->prepare("UPDATE users SET user_reset_passwd_code=:user_reset_passwd_code WHERE username=:username");
                $sql->bindParam(':user_reset_passwd_code', $user_reset_passwd_code);
                $sql->bindParam(':username', $login);
                $sql->execute();
                $sub = "Reset Your Password" ;
                $headers = "MIME-Version: 1.0" . "\r\n";
                $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
                $headers .= "From: Camagru" ;
                $message =" 
                <div class='row'>
                    <div class='container'>
                        <p>Hi <strong>$firstname</strong>!</p>
                        <p>We got a request to reset your Camagru password.</p>
                        <p>Please click the button bellow to change your password.</p>
                        <a href='http://localhost:8080/camagru/main_files/front_end/confirm_passwd.php?log=".urlencode($login)."&key=".urlencode($user_reset_passwd_code)."'>
                        <button type='button' style='color:white;background-color:#007fff;padding:10px;cursor:pointer;border-radius:50px;'>Reset Password</button></a>
                        <hr>
                        <p>If you ignore this message, your password will not be changed.. </p>
                        <hr>
                        <p><strong>no-reply@c3r6s4.wethinkcode.co.za</strong></p>
                    </div>
                </div>";             
                 
                mail($dest, $sub, $message, $headers);
                ?>
                <div class="alert alert-success">
                    <a class="close" aria-label="close">&times;</a>
                    <p>Please, verify your email to reset the password!</p>
                </div>
                <?php
            }
        }
        else
            $error['email'] = "Email not exist!";
        }
    if ($error)
    {?>
        <div class="alert alert-danger">
        <a class="close" aria-label="close">&times;</a>
        <?php 
            foreach($error as $value)
                echo "Error: " . $value . "<br>";
        ?>
        </div>
    <?php
    }
}
?>