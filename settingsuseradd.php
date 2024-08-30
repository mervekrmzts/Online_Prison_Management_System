<?php 
session_start();
include "session.php";
include "config.php"; 

$guvenlikderecesi=2;

if ($_SESSION['security'] > $guvenlikderecesi){
 $alert="<script>alert('You are not authorized to enter this page...');</script>";
echo $alert;
echo "<script>window.location.href = 'dashboard.php';</script>";
exit();
}


if ($_POST) { // Sayfada post olup olmadığını kontrol ediyoruz.
  
  if ($_POST['staff']==""){ //Personel seçilmemişse işlem iptal
    echo "No Staff";
    exit();
  }
  
if ($_POST['username']==""){ // kullanıcı adı girilmemişse işlem iptal
  echo "No User Name";
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

$user1=$_POST['username'];  // kullanıcı adı
$staff=$_POST['staff']; //personel id
$pass1 = $_POST['ps']; // şifre


$sorgu = $conn->query("SELECT COUNT(*) AS sayi FROM users where persid=".$staff); 
$sonuc = $sorgu->fetch_assoc(); //sorgu çalıştırılıp veriler alınıyor
$adet=$sonuc['sayi'];
//ilgili personel için önceden kullanıcı tanımlanmışsa işlemi iptal etme
if ($adet >= 1) {
  $alert="<script>alert('There are already registered users for this Personnel...');</script>";
  echo $alert;
  
  echo "<script>window.location.href = 'settingsusers.php';</script>";
  exit(); 
}
  

$sorgu = $conn->query("SELECT t.gprt, s.id FROM tasks AS t, staffs AS s where t.gorevadi=s.gorev and s.id=".$staff); 
$sonuc = $sorgu->fetch_assoc(); //sorgu çalıştırılıp veriler alınıyor
$sec=$sonuc['gprt']; // güvenlik protokolu

// Sayfa yenilendikten sonra post edilen değerleri değişkenlere atama
         
$data = $user1;
$cipher = 'AES-128-ECB';
$key = 'merve.1071';
$user = openssl_encrypt($data, $cipher, $key); // username bilgisini şifreleme
	
$data = $pass1;
$cipher = 'AES-128-ECB';
$key = 'merve.1071';
$pass = openssl_encrypt($data, $cipher, $key); // password bilgisini şifreleme
   
$sorgu = $conn->query("SELECT COUNT(*) AS sayi FROM users WHERE username='$user'"); 
$sonuc = $sorgu->fetch_assoc(); //sorgu çalıştırılıp veriler alınıyor
$adet=$sonuc['sayi'];
//kullanıcı adı başka bir personel için önceden tanımlanmışsa işlemi iptal etme
if ($adet >= 1) {
  $alert="<script>alert('This username is already registered...');</script>";
  echo $alert;
  
  echo "<script>window.location.href = 'settingsusers.php';</script>";
  exit(); 
}


	       
		// Veri düzenleme sorgusu
		if ($conn->query("INSERT INTO users (username, password, persid, security) VALUES('$user', '$pass', '$staff', '$sec')"))
     
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

  <h2>NEW USER</h2>

  <form action="" method="POST">
    <label for="staff">Staffs:</label>
            <select id="staff" class="combo" name="staff"><!--Personel-->
            <option value="">---Select---</option>
            <?php  
            
            $query = "SELECT s.id, s.ad, s.soyad, s.gorev, t.gorevadi 
                                        FROM staffs AS s
                                        INNER JOIN tasks AS t ON s.gorev=t.gorevadi WHERE t.gprt<>0 AND s.aktiflik='Yes' ORDER BY s.ad ";// kullanıcı olabilecek personelleri veritabanından alma

// Sorguyu çalıştır ve sonucu al
$result = $conn->query($query);

while($sonuc = $result->fetch_assoc()) {
$id = $sonuc['id'];
$ad = $sonuc['ad'];
$soyad = $sonuc['soyad'];
         echo "<option value='" . $sonuc['id'] . "'>" . $sonuc['ad'] ." ". $sonuc['soyad'] . "</option>";
     
  
     }  ?>
          </select><br><br>
  <label for="username">User Name :</label><!--şifre-->
  <input type="text" name="username">
  <label for="ps">Password:</label><!--şifre-->
  <input type="password" name="ps">
  <label for="ps2">Password (Repeat):</label><!--şifre tekrar-->
  <input type="password" name="ps2">
 <button id="btn-save">SAVE</button>

  </form>
 </div>
  </div>  
  
  <div class="right">
  <?php require_once "men.php"; ?>
  </div>
</div>

</body>
</html>
