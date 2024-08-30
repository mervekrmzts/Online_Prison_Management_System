<?php 
session_start();
include "session.php";
include "config.php"; 
$guvenlikderecesi=5;

if ($_SESSION['security'] > $guvenlikderecesi){
 $alert="<script>alert('You are not authorized to enter this page...');</script>";
echo $alert;
echo "<script>window.location.href = 'dashboard.php';</script>";
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

<div class= "header">
   <?php require_once "header.php" ?>
</div>
 
<div style="overflow:auto">
  <div class="menu">
    <?php require_once "menu.php"; ?>
  </div>

  <div class="main">
  <?php include "visitorslist.php"; ?>
  </div>  

  <div class="right">
      
   </div>
</div>

</body>
</html>