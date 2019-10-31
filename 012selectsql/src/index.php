<?php

    // Connexion et sélection de la base
    $conn = mysqli_connect('012selectsqldb', 'not_brutforsable_user', 'not_brutforsable_password', "myDb");

    $candidate=mysqli_real_escape_string($conn, $_REQUEST['query']);

    $query = "SELECT LENGTH((SELECT flag from ctf))-LENGTH(REPLACE((SELECT flag from ctf), '".$candidate."', ''))";


    $result = mysqli_query($conn, $query);
    //$result->fetch_array(MYSQLI_ASSOC);

    $value = $result->fetch_row();



    /* Libération du jeu de résultats */
    $result->close();

    mysqli_close($conn);

    ?>
<html>
 <head>
  <title>Hello...</title>

  <meta charset="utf-8">
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
<style>

#center {
   width: 600px;
   height: 40px;
   position: absolute;
   left: 50%;
   top: 50%;
   margin-left: -300px;
   margin-top: -50px;
   background: rgba(0,0,0,1);
  border: 2px solid rgba(255,255,255,1);
  border-radius: 5px;
  box-shadow: 0px 0px 10px 5px rgba(255,255,255,0.2);
}

#main {
  width: 200px;
   height: 36px;
  background: green;
  float: left;
  animation: stretch <?=(1+$value[0]/20)?>s infinite linear;
}

.row {
  height: 40px;
  width: 400px;
  float: left;
  display: inherit;
  animation: squeeze 5s infinite linear;
}
@keyframes stretch {
    0% {width: 0px;}
    50% {width: <?=(600/83*$value[0])?>px;}
    100% {width: 0px;}}




@import url("https://fonts.googleapis.com/css?family=Inconsolata:700");
* {
  margin: 0;
  padding: 0;
  box-sizing: border-box;
}

html, body {
  width: 100%;
  height: 100%;
}

body {
  background: #252525;
}

center{
    margin-top:100px;
    color: green;
}

.container {
  position: absolute;
  margin: auto;
  top: -40%;
  left: 0;
  right: 0;
  bottom: 0;
  width: 300px;
  height: 100px;
}
.container .search {
  position: absolute;
  margin: auto;
  top: 0;
  right: 0;
  bottom: 0;
  left: 0;
  width: 80px;
  height: 80px;
  background: crimson;
  border-radius: 50%;
  transition: all 1s;
  z-index: 4;
  box-shadow: 0 0 25px 0 rgba(0, 0, 0, 0.4);
}
.container .search:hover {
  cursor: pointer;
}
.container .search::before {
  content: "";
  position: absolute;
  margin: auto;
  top: 22px;
  right: 0;
  bottom: 0;
  left: 22px;
  width: 12px;
  height: 2px;
  background: white;
  transform: rotate(45deg);
  transition: all .5s;
}
.container .search::after {
  content: "";
  position: absolute;
  margin: auto;
  top: -5px;
  right: 0;
  bottom: 0;
  left: -5px;
  width: 25px;
  height: 25px;
  border-radius: 50%;
  border: 2px solid white;
  transition: all .5s;
}
.container input {
  font-family: 'Inconsolata', monospace;
  position: absolute;
  margin: auto;
  top: 0;
  right: 0;
  bottom: 0;
  left: 0;
  width: 50px;
  height: 50px;
  outline: none;
  border: none;
  background: crimson;
  color: white;
  text-shadow: 0 0 10px crimson;
  padding: 0 80px 0 20px;
  border-radius: 30px;
  box-shadow: 0 0 25px 0 crimson, 0 20px 25px 0 rgba(0, 0, 0, 0.2);
  transition: all 1s;
  opacity: 0;
  z-index: 5;
  font-weight: bolder;
  letter-spacing: 0.1em;
}
.container input:hover {
  cursor: pointer;
}
.container input:focus {
  width: 300px;
  opacity: 1;
  cursor: text;
}
.container input:focus ~ .search {
  right: -250px;
  background: #151515;
  z-index: 6;
}
.container input:focus ~ .search::before {
  top: 0;
  left: 0;
  width: 25px;
}
.container input:focus ~ .search::after {
  top: 0;
  left: 0;
  width: 25px;
  height: 2px;
  border: none;
  background: white;
  border-radius: 0%;
  transform: rotate(-45deg);
}
.container input::placeholder {
  color: white;
  opacity: 0.5;
  font-weight: bolder;
}


</style>
</head>
<body>
<center>
<?=(htmlentities($query)."<br>")?>
<b><?=(htmlentities($candidate)."<br>")?></b>
</center>


    <div id="center">

        <div id="main">

        </div>
        <div class="row" id="r-one">
        </div>

    </div>

    <div class="container">
        <form method="POST">
    <input type="text" name="query" placeholder="Search..."><form>
    <div class="search">

    </div>
</div>

</body>
</html>
