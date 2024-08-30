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

  <h2>USER SEE</h2>

  <form action="" method="POST">
    <label for="staff">Staffs:</label>
            <select id="staff" disabled class="combo" name="staff"><!--Personel-->
            <option value="">---Select---</option>
            <?php 
            
            $query = "SELECT s.id, s.ad, s.soyad, s.gorev, t.gorevadi 
                                        FROM staffs AS s
                                        INNER JOIN tasks AS t ON s.gorev=t.gorevadi WHERE t.gprt<>0 ORDER BY s.ad ";// kullanıcı olabilecek personelleri veritabanından alma

// Sorguyu çalıştır ve sonucu al
$result = $conn->query($query);

while($sonuc = $result->fetch_assoc()) {
$id = $sonuc['id'];
$ad = $sonuc['ad'];
$soyad = $sonuc['soyad'];

if ($id==$getid){
         echo "<option selected value='" . $sonuc['id'] . "'>" . $sonuc['ad'] ." ". $sonuc['soyad'] . "</option>";
}else{
  
  echo "<option value='" . $sonuc['id'] . "'>" . $sonuc['ad'] ." ". $sonuc['soyad'] . "</option>";   
}
  
  } 
  
  ?>
          </select><br><br>

    <?php 
    include "config.php";
     
     $sorgu = $conn->query("SELECT username, password FROM users WHERE persid =".$getid); // users ekranından alınan id değeri ile düzenlenecek verileri veritabanından alma
     $sonuc = $sorgu->fetch_assoc(); 


     $data = $sonuc['username'];
     $cipher = 'AES-128-ECB';
     $key = 'merve.1071';
     $user = openssl_decrypt($data, $cipher, $key); // user çözme

     $data = $sonuc['password'];
     $cipher = 'AES-128-ECB';
     $key = 'merve.1071';
     $pass = openssl_decrypt($data, $cipher, $key); // pasword çözme



    
    ?>     

  <label for="username">User Name :</label><!--şifre-->
  <input type="text" disabled name="username" value="<?php echo $user; ?>">
   <label for="ps">Password:</label><!--şifre-->
  <input type="text" disabled name="ps" value="<?php echo $pass; ?>">
  

  </form>
 </div>
  </div>  
  
  <div class="right">
  <?php require_once "men.php"; ?>
  </div>
</div>

</body>
</html>
