<?php 
session_start();
include "session.php";
include "config.php";
 

if ($_POST) { // Sayfada post olup olmadığını kontrol ediyoruz.
  
    $sorgu = $conn->query("SELECT password FROM users where persid=". $_SESSION['userid']); 
    $sonuc = $sorgu->fetch_assoc(); //sorgu çalıştırılıp veriler alınıyor
    $pas1=$sonuc['password']; // güvenlik protokolu
  
    $data = $pas1;
    $cipher = 'AES-128-ECB';
    $key = 'merve.1071';
    $pas = openssl_decrypt($data, $cipher, $key); 



if ($_POST['ps0']!=$pas){ // eski şifre doğru girilmemişse
  echo "Old Password is not correct";
  exit();
}
if ($_POST['ps']==""){ // şifre girilmemişse işlem iptal
  echo "No Password";
  exit();
}
if ($_POST['ps2']==""){// şifre tekrarı girilmemişse işlem iptal  
  echo "No Password (Repeat)";
  exit();
}
if ($_POST['ps']!=$_POST['ps2']){// şifre ve şifre tekrarı uyumlu değilse işlem iptal
  echo "No Password=Password (Repeat)";
  exit();
}


$pass1 = $_POST['ps']; // şifre


// Sayfa yenilendikten sonra post edilen değerleri değişkenlere atama
         
   
	
$data = $pass1;
$cipher = 'AES-128-ECB';
$key = 'merve.1071';
$pass = openssl_encrypt($data, $cipher, $key); 
   

	
       
		// Veri düzenleme sorgusu
		if ($conn->query("UPDATE users SET password='$pass' WHERE persid=" . $_SESSION['userid']))
     
		{
            
         
		}
		else
		{
        	echo mysqli_error($conn);


	}
    // Bağlantıyı kapat
   $conn->close();

   header('Location:settingsusers.php');
}

?>



<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<link rel="stylesheet" href="style.css">
<style>
   .settings {
            width: 450px;
           
            margin: 30px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.4);
            background:transparent;
            backdrop-filter:blur(5px);
            text-align: center;
            font-family: Arial, sans-serif;
            
        }   
        .settings h2{
            color:#8b795e;
        }

        .settings label {
            display: block;
            margin-bottom: 8px;
        }

        .settings input {
            width: 100%;
            padding: 5px;
            margin-bottom: 16px;
            box-sizing: border-box;
            background-color: #fff; 
        }
        .combo{
            padding:4px;
        }

        .settings #btn-save {
            width: 100%;
            padding: 10px;
            margin:10px;
            background-color: #8b795e;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        
        }


        .settings #btn-save:hover {
            background-color:#cdb38b;
        }
        .settings a: hover{
          background-color:#cdb38b;
        
        }
        #btn-list {
            width: 30%;
            padding: 5px;
            background-color: #8b795e;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        

        #btn-list:hover {
            background-color:#cdb38b;


        }


        
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
  <b><h3 style="font-size:25px; text-align:center";>SETTINGS USERS</h3></b>
  <div class="settings">

  <h2>CHANGE PASSWORD</h2>

  <form action="" method="POST">
  

    

  <label for="ps0">Old Password :</label><!--şifre-->
  <input type="password" name="ps0">
   <label for="ps">New Password:</label><!--şifre-->
  <input type="password" name="ps">
  <label for="ps2">New Password (Repeat):</label><!--şifre tekrar-->
  <input type="password" name="ps2">
 
 <button id="btn-save">EDIT</button>

  </form>
 </div>
  </div>  
  
  <div class="right">
  <?php require_once "men.php"; ?>
  </div>
</div>

</body>
</html>
