
<?php 
session_start(); // Oturumu başlat
include "session.php";
include "config.php";
?>
<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Online Prison Menagement System</title>
<link rel="stylesheet" href="style.css">
<style>

</style>
</head>
<body>

<div class="header">
   <?php require_once "header.php" ?>
</div>

 
<div >
  <div class="menu">
 
  </div>

  <div class="main">
    <!-- Önceden açılmış session varsa ana sayfaya yoksa login sayfasına yönlendirme-->
  <?php
  if (isset($_SESSION['username'])){ ?>
    <div class="dashboard"><?php header("Location: dashboard.php"); setcookie('username', $_SESSION['username'])
     ?></div>
    <?php  }else{ ?>
    <div class="login"><?php include 'login.php' ?></div> <?php
    }

    ?>
      
  </div>  

  <div class="right">
    <!--Sağ Menü -->
  </div>
</div>


</body>
</html>