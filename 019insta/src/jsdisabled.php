<!DOCTYPE html>
<html lang="en" >
<head>
  <meta charset="UTF-8">
  <meta http-equiv="Content-Security-Policy" content="default-src 'self' https://www.instagram.com/ 3v1l.cf; style-src 'self'; img-src * data:; media-src *">
  <title>Instagram downloader</title>
  <link rel="stylesheet" href="./style.css">

</head>
<body>
<main>
	<header class="navbar">
		<form method="get">
		<input class="url" name="url" type="text" value="https://www.instagram.com/p/B2tn96foQEG/" placeholder="Paste address here">
    <button class="search">Render</button>
	</header>
	<section class="result">
				<?php 
error_reporting(E_ALL);
include_once("lib_simple_html_dom.php");



if(empty($_GET['url'])){

	echo('<div class="no-image"></div>');
	echo('<p>On this page you can download images or <b>public</b> videos from Instagram accounts, in the application you can go to the image and to the right <b>(the 3 points)</b> in the menu you give it to copy image and paste it or if you are on the computer you just have to Copy the link.</p><p>To save an image from the mobile phone, press and hold until the menu comes out and then download the image if it is from the computer, simply right click save image.</p>
<p>To save a video from your mobile, click on the 3 dots and download and if you are on the computer, right click and save as.</p><p>This page does not save any information do not worry :).</p>');

}else{
	$url=$_GET['url'];
	$html = file_get_html($url);
	$img=($html->find('meta[property=og:image]')[0]->content);
	$video=($html->find('meta[property=og:video]')[0]->content);
	$description=($html->find('meta[property=og:description]')[0]->content);
	if($video){
	echo('<video id="instavideo" src="'.$video.'" controls="" autoplay=""></video>');
}else{
	echo('<img id="instaImg" src="'.$img.'">');
}
	echo('<p>'.htmlspecialchars_decode($description).'</p>');
	
}
?>

	</section>

<footer>Made width ♥ <br>
		If your link does not work - send it to me
		<form action="feedback.php"></form>
		<form action="feedback.php" method="post">
			<input type="text" name="link">
			<input type="submit" name="">
		</form>
</footer>
</main>



</body>
</html>