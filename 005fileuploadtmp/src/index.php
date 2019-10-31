<?php

if(empty($_GET["page"])){
  header("Location: index.php?page=index.html");
}else{
  if($_GET["page"]=="index.php"){
    $_GET["page"]="index.html";
  }

  include($_GET["page"]);

  }

 ?>
