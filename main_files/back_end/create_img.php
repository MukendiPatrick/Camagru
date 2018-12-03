<?php
require_once '../set_conf/session_start.php';

    if (isset($_POST['base64']) && isset($_POST['src']))
    {
         if (!is_dir('../../users_photos'))
         {
            mkdir('../../users_photos');
            if (!is_dir('../../users_photos/'.$login))
            mkdir('../../users_photos/'.$login);
         }
           
         else
         {
         if (!is_dir('../../users_photos/'.$login))
             mkdir('../../users_photos/'.$login);
         }
       
        $name_img = md5(rand());
        $data = str_replace(" ", "+", htmlspecialchars($_POST['base64']));
        $plainText = base64_decode($data);
        $filename = '../../users_photos/'.$login.'/'.$name_img.'.png';
        file_put_contents($filename, $plainText);
        if (exif_imagetype($filename) == 3)
        {
            $filter = htmlspecialchars($_POST['src']);
            $source = imagecreatefrompng($filter);
           $dest = imagecreatefrompng($filename);
           
            $width_source = imagesx($source);
            $heigth_source = imagesy($source);
            
            $width_dest = imagesx($dest);
            $heigth_dest = imagesy($dest);
            $dest_x = $width_dest / 2 - $width_source / 2;
            $dest_y =  $heigth_dest / 2 - $heigth_source / 2;
            imagecopy($dest, $source, $dest_x, $dest_y, 0, 0, $width_source, $heigth_source); 
            
            imagepng($dest, $filename);
            $arr = ["file" => $filename];
            echo json_encode($arr);
        }
    }
?>