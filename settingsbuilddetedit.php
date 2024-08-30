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

<?php

if ($_POST) { // Sayfada post olup olmadığını kontrol ediyoruz.

// Sayfa yenilendikten sonra post edilen değerleri değişkenlere atama
         
    $binaid = $_POST['building'];
	$oda = $_POST['build']; 
	
   
   

	if ($oda<>"") { //  başka kontrollerde yapaılabilir
       
		// Veri düzenleme sorgusu
		if ($conn->query("UPDATE buildingdetail SET binaid='$binaid', oda='$oda' WHERE idbt=".$getid)) 
		{
            
         
		}
		else
		{
        	echo mysqli_error($conn);
		}

	}
   

   header('Location:settingsbuildingdetail.php');
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
  <b><h3 style="font-size:25px; text-align:center";>SETTINGS BUILDING</h3></b>
  <div class="settings">

  <?php 

$sorgu2 = $conn->query("SELECT * FROM buildingdetail WHERE idbt=".$getid); 
$sonuc2 = $sorgu2->fetch_assoc(); //sorgu çalıştırılıp veriler alınıyor
$binaid=$sonuc2['binaid'];
$oda=$sonuc2['oda'];
?>

  <form action="" method="POST">
  <label for="building">Building:</label>
            <select id="building" class="combo" name="building"><!--Binalar-->
            <option value="">---Select---</option>
            <?php  
            
            $query = "SELECT idb, bina FROM building";// görevleri veritabanından alma

// Sorguyu çalıştır ve sonucu al
$result = $conn->query($query);

while($sonuc = $result->fetch_assoc()) {
$id = $sonuc['idb'];
$binadi = $sonuc['bina'];

    if ($id==$binaid){
        echo "<option selected value='" . $sonuc['idb'] . "'>" . $sonuc['bina'] . "</option>";
    }else{
         echo "<option value='" . $sonuc['idb'] . "'>" . $sonuc['bina'] . "</option>";
    }
  
     }  ?>
          </select><br>

  <label for="build">Detail:</label><!--Düzeltilecek bina bilgisini alma-->
  <input type="text" name="build" value="<?php echo $oda; ?>">

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