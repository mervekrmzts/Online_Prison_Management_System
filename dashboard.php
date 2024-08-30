<?php

session_start();
include "session.php";
include "config.php";


if (isset($_COOKIE["username"])){
$_SESSION['username'] = $_COOKIE["username"];
setcookie('username', $_SESSION['username'],time()-60);
}else{
  header('Location: index.php');
   exit();
}

?>

<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<link rel="stylesheet" href="style.css">
<style>

</style>
</head>
<body>

<div class="header">
   <?php require_once "header.php" ?>
</div>

 
  <div style="overflow:auto">
  <div class="menu">
  <?php require_once "menu.php"; ?>
  </div>

  <div class="main">
  <?php
  
?>

  </div>  

  <div class="right">
    <!--Sağ Menü-->
  </div>
</div>

</body>
</html>