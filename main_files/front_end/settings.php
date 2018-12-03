<!DOCTYPE html>
<html>
<head>
    <title>Settings Page</title>
    <style>
</style>
</head>
<body>

<?php
require_once '../actions/act_settings.php';
require_once 'header.php';
?>
<section class="sectionsettings">
    <div class="row">
        <div class="container">
            <div class="row divform">
                <div class="user_info col-md-6 center">
                    
                        <label for="file"><img src='<?php echo $photo_profile_url?>' width="150" style="border-radius: 10%" alt="" id="photo_profil_settings" draggable="false">
                        
                        <a><i><p class="center"><div style="color:red">Change your Profile Picture</div></p></i></a>
                        </label>
                        <input type="file" class="input-file" name="pic" accept="image/*" id='file' src="" onchange="upload_photo_profil(this)" onclick="this.value=null;">

                    <h1 class="center"><div style="color:#007fff">Settings</div></h1>
                    <p class="center">Manage information about you and your account in general.</p>
                        <form method="POST"  id="registerform" >
                            <input type="text" name="username" value="" placeholder="New username">
                            <input type="email" name="email" value="" placeholder="New Email">
                            <input type="password" name="old_passwd" value="" placeholder="Old Password">
                            <input type="password" name="new_passwd" value="" placeholder="New Password">
                            <input type="password" name="confnew_passwd" value="" placeholder="Confirm New Password">
                            <button class="settings submit btn"type="submit" name="submit" value="OK">Save</button>
                            <button class="settings reset btn" type="reset" name="reset" value="Reset">Cancel</button>
                        </form>
                    </div>
                <div class="user_prefeferences col-md-6">
                <i class="fa fa-cog fa-spin" style="font-size:48px;color:red"></i>
                    <h3 class="center"><div style="color:#007fff">Enable/Disable your notifications <img src="../extra_files/images/bell.gif" width="50"> </div></h3>
                    <div class="row notif_row">
                        
                        <form class="notif_form">
                            <label class="switch">
                                <input type="checkbox"  id="myCheck" onclick="check_notif()" <?php if ($notif == 'yes') echo 'checked';?>>
                                <span class="slider round"></span>
                            </label>
                        </form>
                        
                    </div>
                    
                     <div class="row notif_row">
                     
                        <select id="selectTheme" onchange="change_theme(this.id)" name="test">
                        
                            <option value="1" id="defaultTheme"  <?php if ($theme == 'Default') echo "selected";?>>Default</option>
                            <option value="3" id="cyanTheme" <?php if ($theme == 'cyan') echo "selected";?>>cyan</option>
                            <option value="4" id="lavenderTheme" <?php if ($theme == 'lavender') echo "selected";?>>lavender</option>
                        </select>
                        <h5 style="float: right "><div style="color:#007fff">Theme&nbsp</div></h5>
                     </div>  
                </div>
            </div>
        </div>
    </div>

</section>
<?php
require_once 'footer.php';
?>
</html>

