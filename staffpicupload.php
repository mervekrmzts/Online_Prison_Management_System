<?php 
session_start();
include "session.php";
include "config.php"; 
$getid=$_GET['id'];
$guvenlikderecesi=2;

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

        .login-container input {
            width: 100%;
            padding: 10px;
            background-color: #8b795e;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .login-container input:hover {
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
    <div class="login-container">
       <form action="" method="post" name="resimyukle" enctype="multipart/form-data"> 
       <input type="file" name="resim"/>
       <input type="submit" name="gonder" value="Upload a Picture"/></form>
    </div>
  </div>  

  <div class="right">
    <!--Sağ Menü -->
  </div>
</div>

</body>
</html>

<?php
if ($_POST){
$dosya=$_FILES["resim"]["tmp_name"];
$yeniad="staffpic/".$getid.".jpg";
unlink ($yeniad);
if (move_uploaded_file($dosya, $yeniad)){
    
    
    $sql=("UPDATE staffs SET resim= '$yeniad' WHERE id =".$getid); //id değeri ile düzenlenecek verileri veritabanından alacak sorgu
    echo $getid;
    echo "<br>";
    echo $yeniad;
    echo "<br>";
    // Sorguyu çalıştırma ve sonucu kontrol etme
if ($conn->query($sql) === TRUE) {
    echo "Kullanıcı bilgileri başarıyla güncellendi.";
} else {
    echo "Hata: " . $sql . "<br>" . $conn->error;
}

// Veritabanı bağlantısını kapat
$conn->close();

    header("Location: staffedit.php?id=".$getid);


}else{
    echo "başarısız";
}
}


?>





