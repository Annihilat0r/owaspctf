<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {

$flag = 'FLAG{Home_is_where_my_cat_is}';


    $url = trim($_POST["link"]);

echo($url);

      $url_check = "OK";
      $url = escapeshellcmd($_POST["link"]);
      echo("<br>".$url);
      shell_exec('/opt/casperjs/bin/casperjs /opt/bot.js  '.$_SERVER["HTTP_HOST"]." ".$flag." ".$url);

  }
      header("Location: /");
      exit;

?>
