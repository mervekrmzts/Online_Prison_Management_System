<?php
session_start(); // Oturumu başlat

include('config.php'); // Veritabanı bağlantı dosyasını dahil et

// Formdan kullanıcı adı ve şifreyi al
$username1 = $_POST['username'];
$password1 = $_POST['password'];

$data = $username1;
$cipher = 'AES-128-ECB';//method
$key = 'merve.1071';//anahtar
$username = openssl_encrypt($data, $cipher, $key);//şifrelenmiş veritabanı username bilgisi ile karşılaştırma

$data = $password1;
$cipher = 'AES-128-ECB';
$key = 'merve.1071';
$password = openssl_encrypt($data, $cipher, $key); //şifrelenmiş veritabanı password bilgisi ile karşılaştırma





// Kullanıcı adı ve şifreyi veritabanında kontrol et
$query = "SELECT * FROM users WHERE username='$username' AND password='$password'";
$result = $conn->query($query);
$row = $result->fetch_assoc(); // Sonuç kümesinden bir satır al






if ($result->num_rows == 1) {
    // Kullanıcı doğruysa, oturum değişkenlerini ayarla
    $_SESSION['username'] = $username;
    
    setcookie('username', $_SESSION['username']);



    $_SESSION['security'] = $row['security']; // 'persid' değerini al
    $_SESSION['userid'] = $row['persid']; // 'persid' değerini al
    
    if ($row['persid']==0) {
      $_SESSION['isim']="Admin";
    }else{
    $query = "SELECT ad, soyad FROM staffs WHERE id='" . $row['persid'] . "'";
    $result = $conn->query($query);
    
    
        $row = $result->fetch_assoc(); // Sonuç kümesinden bir satır al
        $_SESSION['isim'] = $row['ad'] . " " . $row['soyad']; // 'ad' ve 'soyad' değerlerini birleştirip atama yap
    
    }




// Ana sayfaya yönlendir
header('Location: index.php');
   exit();
} else {
    // Kullanıcı doğru değilse, hata mesajı ver
    $uyari= "Username or password is incorrect!";
}

// Bağlantıyı kapat
$conn->close();
?>




<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<link rel="stylesheet" href="style.css">
<style>
        .login-container {
            width: 300px;
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
         .login-container h2{
            color:#8b795e;
        }

        .login-container label {
            display: block;
            margin-bottom: 8px;
        }

        .login-container input {
            width: 100%;
            padding: 8px;
            margin-bottom: 16px;
            box-sizing: border-box;
            background-color: #fff; 
        }

        .login-container button {
            width: 100%;
            padding: 10px;
            background-color: #8b795e;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .login-container button:hover {
            background-color:#cdb38b;
        }
    </style>
</head>
<body>

<div class="header">
   <?php require_once "header.php" ?>
</div>

 
  <div style="overflow:auto">
  <div class="menu">
 
  </div>

  <div class="main">
    <br><br>
  <div class="login-container">
    <?php echo $uyari; ?>

  <h4 style=text-align:center><a href="index.php">Back Arrow</a></h4></div>
  </div>  

  <div class="right">
    <!--Sağ Menü kısımı -->
  </div>
</div>

</body>
</html>


