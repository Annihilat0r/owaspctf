<?php
header('Content-Type: text/plain');
//var_dump($_FILES['file']);
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_FILES['file'])) {
        $errors = [];

        $path = 'uploads/';
        $extensions = ['jpg', 'jpeg', 'png', 'gif'];

        $all_files = count($_FILES['files']['tmp_name']);


            $file_name = $_FILES['file']['name'];
            $file_tmp = $_FILES['file']['tmp_name'];
            $file_type = $_FILES['file']['type'];
            $file_size = $_FILES['file']['size'];
            $file_ext = strtolower(next(explode('.', $_FILES['file']['name'])));
            $file = $path . $file_name . ".txt";

            if (!in_array($file_ext, $extensions)) {
                $errors[] = 'Extension not allowed: ' . $file_name . ' ' . $file_type;
            }

            if ($file_size > 2048) {
                $errors[] = 'File size exceeds limit: ' . $file_name . ' ' . $file_type;
            }

            if (empty($errors)) {
                sleep(1);
                $fp = fopen('upload_log.txt', 'a');//opens file in append mode
                fwrite($fp, date('Y-m-d H:i:s') . " : " .$_SERVER['REMOTE_ADDR']."\n");
                fwrite($fp, $file_tmp."\n");
                fclose($fp);
                //move_uploaded_file($file_tmp, $file);
                sleep(15);
            }


        if ($errors) print_r($errors);

    }
}
show_source(__file__);
?>
