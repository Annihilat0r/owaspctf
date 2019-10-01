<?php
// 0x1234Ab
// 1193131
	$flag = 'FLAG{Daenerys_will_die_in_the_end}';
	if(isset($_POST['password']) && isset($_POST['username'])){
		$username = ($_POST['password']);
		$password = ($_POST['username']);

		if ((md5($username) != md5($password)) && ($username == $password)){
			echo $flag;
		}else{
			echo("Wrong credentials");
		}
	}
?>
