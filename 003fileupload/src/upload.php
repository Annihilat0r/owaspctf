<?php
error_reporting(1);
$target_dir = "images/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
    $check = preg_match('/(.jpg|.jpeg|.png|.gif)/', $_FILES["fileToUpload"]["name"]);
    //print($check);
    if($check !== 0) {

        $uploadOk = 1;
    } else {

        $uploadOk = 0;
    }

    if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";
    // if everything is ok, try to upload file
    } else {
        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
            echo "File has been uploaded.";
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }
  }


?>
