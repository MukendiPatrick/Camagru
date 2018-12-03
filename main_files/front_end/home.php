<?php
ini_set('display_errors', 'On');
require_once  '../class/mypdo.class.php';
require_once  '../set_conf/session_start.php';

$title = 'Home';
$js_source = ['../script/ft_webcam.js', '../script/post_del_cancel_photo_.js'];

if (isset($_SESSION['user_id']))
{
?>
<section class="body_magin">
<div class="usearea_container">
  <div class="image_publish">
    <div class="row">
      <img  src="" id="photo" alt="photo">
    </div>
    <div class="row buttons-row">
      <div class="buttons col-md-12">
        <button type="submit" id="publishbutton" class="col-md-6  btn-success" onclick="post_photo()">Publish</button>
        <button type="submit" id="deletebutton" class="col-md-6  btn-danger" onclick="cancel_photo()">Cancel</button>
      </div>
    </div>
  </div>
</div>

<div class="container">
<div class="col-md-6">
<div class="row filters">
    <form class="form-horizontal" role="form">
      <div class="row">
        <div class="col-md-3 col-xs-6">
        <center><h2 style="color:white; font-size:1.4vw;">Filters</h2></center>

          <div>
          <img style="i" src="../extra_files/images/phone_frame.png" class="img-responsive img-radio" draggable="false">
          <button type="button" class="btn btn-primary btn-radio active" onclick="ft_selectframe(this.id)" id="1">
          <b style="font-size:0.5vw;">Phone</b></button>
          <input type="checkbox" name="src" class="hidden">
          </div>

          <div>
          <img src="../extra_files/images/border2.png" class="img-responsive img-radio" draggable="false">
          <button type="button" class="btn btn-primary btn-radio" onclick="ft_selectframe(this.id)" id="2">
          <b style="font-size:0.5vw;">Wooden Frame</b></button>
          <input type="checkbox" name="src" class="hidden">
          </div>

          <div>
          <img src="../extra_files/images/border1.png" class="img-responsive img-radio" draggable="false">
          <button type="button" class="btn btn-primary btn-radio" onclick="ft_selectframe(this.id)" id="3">
          <b style="font-size:0.5vw;">Flowers Frame</b></button>
          <input type="checkbox" name="src" class="hidden">
          </div>

          <div>
          <img src="../extra_files/images/rainbow.png" class="img-responsive img-radio" draggable="false">
          <button type="button" class="btn btn-primary btn-radio" onclick="ft_selectframe(this.id)" id="4">
          <b style="font-size:0.5vw;">Rainbow</b></button>
          <input type="checkbox" name="src" id="4" class="hidden">
          </div>
        </div>

        
        <div class="col-md-9 col-xs-6">
        <center><h2 style="color:white; font-size:1.4vw;">Webcam</center>
        <h3 class="center" style="color: #007fff">Select a filter and then take a picture</h3><br>
            <div class="row">
            <div class="div_take_photo">
              <video id="video"></video>
              <canvas id="canvas"></canvas>
              <div>

                <label type="submit" id="startbutton">
                  <a href='ft_instagram.php'><img src="../extra_files/images/camera.png" alt="take_picture" width="65" height="10"></a>
                </label>

                <label id="upload_photo" for="file" style="float: right">
                    <img src="../extra_files/images/upload.jpg" alt="upload" width="65" height="650">
                </label>
              

                <input type="file" class="input-file" name="pic" accept="image/png" id='file' src="" onchange="encode_photo(this)" onclick="this.value=null;"> 
              </div>
            </div>
          </div>

              <div class="row filters">
                  <img style="opacity:0" src="#" class="img-responsive img-radio" draggable="false">
                  <button type="button" class="btn btn-primary btn-radio active" onclick="photo_without_frame(this.id)" id="1"><h3 style="color:white; font-size:1.1vw;">Take a picture without a filter</h3></button>
                  <input type="checkbox" name="src" class="hidden">
              </div>
        </div>
        </div>
      </div>
    </form>
  </div>

<div class="col-md-6 last_photos">
<center><h2 style="color:white; font-size:1.4vw;">Pictures</h2></center>
<?php
  $query = '
    SELECT image_url, image_id
  FROM users
  INNER JOIN instagram ON users.user_id = instagram.user_id
  WHERE instagram.user_id=:user_id
  ORDER BY instagram.date_time_photo DESC
  LIMIT 8';

  $query = $pdo->prepare($query);
  $query->execute(
    array(
      ':user_id' => $_SESSION['user_id']
    )

  );
  $count = $query->rowCount();
 
  if ($count > 0)
  {
    $result = $query->fetchAll();
      foreach ($result as $row)
      {
        ?>
        <div class="col-md-6 col-xs-6">
        <a  href="<?php echo $row['image_url']?>">
        <img class="thumbnails" src="<?php echo $row['image_url']?>" alt="">
      </a>
        <center><button class="delete_last_photo" style="border-radius:30px, width: 10px" onclick="del_photo(<?php echo  $row['image_id'];?>)">
        
        <i class="fa fa-trash" aria-hidden="true"></i>
        
        
        </button><center>
        </div>
        <?php
      }
  }
    ?>
  </div>
  </div>
</section>

<div class="toppane">
  <?php 
  echo '<div id="alert"></div>';
  require_once 'header.php';?>
</div>

<?php
require_once 'footer.php';
}
else
  header ('location: login.php');
?>
