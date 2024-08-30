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
  if(isset($_POST['asis']) && $_POST['asis'] == 'Yes') {
    $aktiflik= "Yes";
} else {
    $aktiflik="No";
}
  

  if ($conn->query("UPDATE settings SET asis='$aktiflik'"))// yeni tercihi veritabanına aktarma
{
}else{
  echo mysqli_error($conn);
}

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
            background-color: #cdb38b;


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
  <b><h3 style="font-size:25px; text-align:center";>SETTINGS STAFF</h3></b>
  <div class="settings">

  <?php 

$sorgu = $conn->query("SELECT * FROM settings"); 
$sonuc = $sorgu->fetch_assoc(); //sorgu çalıştırılıp veriler alınıyor

?>

  <form action="" method="POST">
  <label for="asis">Also show inactive staff</label><!--Aktif olmayan personellerin gösterilip gösterilmemesine karar verme durumunu gösterme-->
  <select id="asis" class="combo" name="asis">
            <?php if ( $sonuc['asis']=="Yes"){ ?>
                <option selected value="Yes">Yes</option>
                <option value="No">No</option>
                <?php }else{ ?>
                <option value="Yes">Yes</option>
                <option selected value="No">No</option>
                <?php } ?>
                </select>  <br><br>
 <button id="btn-save">EDIT</button>

  </form>
 </div>
  </div>  
  <?php
  // Bağlantıyı kapat
    $conn->close();
    ?>
  <div class="right">
  <?php require_once "men.php"; ?>
  </div>
</div>

</body>
</html>