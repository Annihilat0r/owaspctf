<?php
session_start();
//var_dump($_SESSION);
error_reporting(E_ALL);
error_reporting(-1);
ini_set('error_reporting', E_ALL);
    header('Content-type: image/png');


        $text = "(".$_SESSION['firs']."+".$_SESSION['second'].")*".$_SESSION['third']."-".$_SESSION['four'];
        $font_size = 20;
        $image = imagecreatetruecolor(320, 40);
        $bgColor = imagecolorallocate($image, 44,51,56);
        imagefill($image , 0, 0, $bgColor);
        imagecolorallocate($image, 30, 30, 30);
        $font_color = imagecolorallocate($image, 169, 169, 169);
        imagettftext($image, $font_size, 0, 15, 27, $font_color, "unispace.ttf", $text);
        imagepng($image);
        imagedestroy($image);

?>
