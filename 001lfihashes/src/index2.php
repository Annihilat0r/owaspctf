<?php

echo("Directory listing");
$files=(scandir("./"));

foreach($files as $file){

	echo("<br><a href='./developers_mod_v7499.php?file=".$file."'>".$file);
	

}

?>
