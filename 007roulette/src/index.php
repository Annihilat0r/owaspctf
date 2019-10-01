<?php

echo('<center><form method="post">
<input type="text" name="flag_ckeck"><br>
<input type="submit" value="Enter">');
echo('</form>');
$flag="FLAG{To_infinity...and_beyond!}";
$answer="";
$check_string=md5($_REQUEST['flag_ckeck']);
if(!empty($_REQUEST['flag_ckeck'])){
	for($i = 0; $i <= 32; $i++){

		if($check_string[$i]==5){
			$answer=$answer.$flag[$i];
		}else{
			$answer=$answer."*";
		}
	}
	echo($answer."<br>");
}


?>

<img class="emoji" draggable="false" alt="🐝" src="/17665.jpg">
