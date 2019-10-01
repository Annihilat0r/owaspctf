<?php
session_start();
if(!isset($_SESSION['difficulty'])){
  $_SESSION['difficulty']=1;
}
$difficulty=$_SESSION['difficulty'];
$flag="FLAG{completely_automated_public_turing_test}";
?>
<!DOCTYPE html>
<html lang="en" >
<head>
  <meta charset="UTF-8">
  <title>Login Form</title>
  <link rel="stylesheet" href="./style.css">
</head>
<body>
<!-- partial:index.partial.html -->
<html lang="en-US">
<head>
  <meta charset="utf-8">
    <title>Login</title>

    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:400,700">

</head>
    <div id="login">
      <form name='form-login' method="post">
        <span class="fontawesome-user"></span>
          <input name="login" type="text" id="user" placeholder="Username">

        <span class="fontawesome-lock"></span>
          <input type="password" name="password" id"pass" placeholder="Password">

					<?php
					if (($_POST["login"]=="admin") && ($_POST["password"]=='admin')) {
            $_SESSION['difficulty']++;
						echo ('

            <span class="fontawesome-flag"></span>
              <input type="text" name="captcha" placeholder="Captcha">

              <img class="emoji" draggable="false" src="/img.php">

              <svg width="75" height="75" viewbox="0 0 250 250">
  <path id="border" transform="translate(125, 125)"/>
  <path id="loader" transform="translate(125, 125) scale(.84)"/>
</svg>');
if(isset($_POST['captcha'])){

  if($_SESSION['time']>time()){
              if($_SESSION['result']==$_POST['captcha']){
                echo($flag);
              }else{

                echo "<center>Wrong CAPTCHA</center>";
              }}else {
                echo("<center>Code expired</center>");
              }}
					}else{
            if(isset($_POST['login'])||isset($_POST['password']))
						echo "<center>Login or password incorrect</center>";
					}

					?>

        <input type="submit" value="Login">

</form>
<!-- partial -->

</body>
<script>
var loader = document.getElementById('loader')
  , border = document.getElementById('border')
  , α = 0
  , π = Math.PI
  , t = 15;

(function draw() {
  α++;
  α %= 360;
  var r = ( α * π / 180 )
    , x = Math.sin( r ) * 125
    , y = Math.cos( r ) * - 125
    , mid = ( α > 180 ) ? 1 : 0
    , anim = 'M 0 0 v -125 A 125 125 1 '
           + mid + ' 1 '
           +  x  + ' '
           +  y  + ' z';

  loader.setAttribute( 'd', anim );
  border.setAttribute( 'd', anim );

  setTimeout(draw, t);
  setTimeout(function() {loader.style.display='none';border.style.display='none'}, 6020);


})();


</script>
</html>
<?php
$_SESSION['firs']=rand(1,8+($difficulty));
$_SESSION['second']=rand(1,8+(2*$difficulty));
$_SESSION['third']=rand(1,9);
$_SESSION['four']=rand(1,8+(3*$difficulty));
$_SESSION['result']=((intval($_SESSION['firs'])+intval($_SESSION['second'])) * intval($_SESSION['third']))-intval($_SESSION['four']);
$_SESSION['time']=time()+6;
?>
