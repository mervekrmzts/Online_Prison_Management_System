<?php 
session_start();
include "session.php";
include "config.php";

$guvenlikderecesi=7;

if ($_SESSION['security'] == $guvenlikderecesi || $_SESSION['security'] == 0){

}else{
 $alert="<script>alert('You are not authorized to enter this page...');</script>";
echo $alert;
echo "<script>window.location.href = 'dashboard.php';</script>";
exit();
}



?>

<?php

if ($_POST) { // Sayfada post olup olmadığını kontrol ediyoruz.





// Sayfa yenilendikten sonra post edilen değerleri değişkenlere atama
    $date=$_POST['date']; 
    $breakfast=$_POST['breakfast']; 
	$lunch=$_POST['lunch']; 
	$dinner=$_POST['dinner']; 
   
   

	if ($breakfast!="") { 
       
		// Veri düzenleme sorgusu
		if ($conn->query("INSERT INTO nutrition (tarih, kahvalti, oglen, aksam) VALUES('$date', '$breakfast', '$lunch', '$dinner')"))
     
		{
            
         
		}
		else
		{
        	echo mysqli_error($conn);
		}

	}
   
   $conn->close();

   header('Location:foodlist.php');
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
            margin:1px, 1px;
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
  <b><h3 style="font-size:25px; text-align:center";>SETTINGS FOOD LİST</h3></b>
  <div class="settings">
  <b><h2>NEW FOOD LİST</h2></b>
  <form action="" method="POST">
  <label for="date">Date:</label> 
  <input type="date" name="date">
  <label for="breakfast">Breakfast:</label> 
  <textarea id="breakfast" name="breakfast" rows="4" cols="58" placeholder="Breakfast"></textarea><!--Kahvaltı-->
  <label for="lunch">Lunch:</label> 
  <textarea id="lunch" name="lunch" rows="4" cols="58" placeholder="Lunch"></textarea><!--Öğlen yemeği-->
  <label for="dinner">Dinner:</label> 
  <textarea id="dinner" name="dinner" rows="4" cols="58" placeholder="Dinner"></textarea><!--Akşam yemeği-->
  


 <button id="btn-save">SAVE</button>

  </form>
 </div>
  </div>  
  
  <div class="right">
  
  </div>
</div>

</body>
</html>
