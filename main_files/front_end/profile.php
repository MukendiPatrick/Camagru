<?php
require_once '../actions/act_profile.php';

?>

<!DOCTYPE html>
<html>
<head>
    <title>Profile Page</title>
    
<style>
#customers {
    font-family: Helvetica, sans-serif;
    border-collapse: collapse;
    width: 100%;
}

#customers td, #customers th {
    border: 1px solid #ddd;
    padding: 8px;
}

#customers tr:nth-child(even){background-color: #f2f2f2;}

#customers tr:hover {background-color: #ddd;}

#customers th {
    padding-top: 12px;
    padding-bottom: 12px;
    text-align: left;
    background-color: #4CAF50;
    color: white;
}
</style>

</head>
<body>
<div class="settings row">
    <div class="profile image settings">
        <label for="file"><img src='<?php echo $photo_profile_url?>' alt="" id="photo_profil_settings" draggable="false"></label>
        <input type="file" class="input-file" name="pic" accept="image/*" id='file' src="" onchange="upload_photo_profil(this)" onclick="this.value=null;">
        
    </div>
</div>

<section class="sectionsettings">
    <div class="row">
        <div class="container-card">
            <div class="row divform">
                <div class="user_info col-md-12">
                    
                    <div align="center" style="vertical-align:bottom">
                    <div align="center" style="vertical-align:bottom">
                    <table id="customers">
                        <tr>
                            <th><p class="center"><i class="fa fa-user-circle settings"></i><b>Personal Details</b></p></th>
                        </tr>
                        <tr>
                            <td><b>User Name:</b><?php echo " " . $login ?></td>
                        </tr>
                        <tr>
                            <td><b>First Name:</b><?php echo " " . $fname ?></td>
                        </tr>
                        <tr>
                            <td><b>Last Name:</b><?php echo " " . $lname ?></td>
                        </tr>
                        <tr>
                            <td><b>E-mail Add:</b><?php echo " " . $email ?></td>
                        </tr>
                    </table>
                    </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
</body>
</html>

