<?php
class User {
	private $username;
	private $isAdmin;

	public function __construct($username, $isAdmin, $borntime) {
		$this->username = $username;
		$this->isAdmin = $isAdmin;
		$this->borntime = $borntime;

	}


	public function printHTML() {
		if ($this->isAdmin) {
			$pic = "/images/admin.jpg";
		} else {
			$pic = "/images/guest.jpg";
		}

		echo "<div class=\"avatar\">\n";
		echo "<img alt=\"\" src=\"" . $pic . "\">\n";
		echo "</div>\n";
		echo "<div class=\"info\">\n";
		echo "<div class=\"title\">$this->username </div>\n";
		echo "<div class=\"desc\">" . ($this->isAdmin ? "Darth Vader" : "Anonymous Stormtrooper") . "</div>\n";
		echo "</div>\n";
		echo "<div class=\"bottom\">\n";
		echo "<p>Born: " . `/bin/date --date=@$this->borntime` . "</p>\n";
		echo "</div>\n";
	}
}


if (!isset($_COOKIE["userdata"])) {
	$user = new User(sprintf("TK-%03d", rand(1, 999)), false, `/bin/date +%s` );
	$serializedUser = serialize($user);
	setcookie("userdata", $serializedUser);
	header("Location: /index.php");
}
?>

<!DOCTYPE html>
<html>
	<!--
	Pictures based on:
		* https://www.flickr.com/photos/bakaotaku/16286352389
		* https://www.flickr.com/photos/bakaotaku/16470867661
		* https://www.flickr.com/photos/mvannorden/8276145052
	Under "CC Attribution 2.0 Generic" license:
		* https://creativecommons.org/licenses/by/2.0/
	-->
	<head>
		<title>The path to the dark side</title>

		<link rel="stylesheet" href="/css/bootstrap.min.css">
		<script src="/js/bootstrap.min.js"></script>
		<link rel="stylesheet" href="/css/font-awesome.min.css">
		<link rel="stylesheet" href="/css/profile.css">
	</head>
	<body>
		<div class="container">
			<div class="row">
				<div class="center col-lg-3 col-md-4 col-sm-5">
					<div class="card hovercard">
						<div class="cardheader"></div>
						<?php
						$user = unserialize($_COOKIE["userdata"]);

						$user->printHTML();
					
						?>
					</div>
				</div>
			</div>
		</div>
	</body>
</html>
