<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if(isset($_POST['g-recaptcha-response'])){
    $captcha=$_POST['g-recaptcha-response'];
  }
  if(!$captcha){
    echo '<h2>Please check the the captcha form.</h2>';
    header("Location: /");
    exit;
  }
  $secretKey = "6LedRrsUAAAAAGwOcORwwh9l4n2P5jdEMKCX4WrO";
  $ip = $_SERVER['REMOTE_ADDR'];
  // post request to server
  $url = 'https://www.google.com/recaptcha/api/siteverify?secret=' . urlencode($secretKey) .  '&response=' . urlencode($captcha);
  $response = file_get_contents($url);
  $responseKeys = json_decode($response,true);
  // should return JSON with success as true
  if($responseKeys["success"]) {
          $flag = 'FLAG{Home_is_where_my_cat_is}';




    $url = trim($_POST["link"]);

      //echo($url);

      $url_check = "OK";
      $url = escapeshellarg($_POST["link"]);
      shell_exec('/opt/casperjs/bin/casperjs --ignore-ssl-errors=true  /opt/bot.js  '.$_SERVER["HTTP_HOST"]." ".$flag." ".$url);

  }}
      header("Location: /");
      exit;

?>
