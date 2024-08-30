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

if ($_POST) { // Sayfada post olup olmadığını kontrol ediyoruz.
  $visitorname=$_POST['visitorname'];
  $prisonid=$_POST['prisonid'];
  $visitingdate=$_POST['visitingdate'];
  $starttime=date('H:i');
  

  if ($prisonid!="") { //  başka kontrollerde yapaılabilir
       
    // Veri düzenleme sorgusu
    if ($conn->query("INSERT INTO visitors (ziyaretci, mahkid, ziyarettarihi, baslamasaati) VALUES('$visitorname', '$prisonid', '$visitingdate', '$starttime')"))
 
    {
        
     
    }
    else
    {
        echo mysqli_error($conn);
    }

}
// Bağlantıyı kapat
$conn->close();

header('Location:visitors.php');

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
            background-color: #1b8bb4;


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
  <b><h3 style="font-size:25px; text-align:center";>VISITORS</h3></b>
  <div class="settings">
<h2>NEW VISITOR</h2>


  <form action="" method="POST">
  <label for="visitorname">Visitor Name /Surname:</label>
  <input type="text" name="visitorname" id="visitorname"><!--Mahkumlar-->

  <label for="prisonname">Prison Name:</label>
  <select id="prisonid" class="combo" name="prisonid"><!--Mahkumlar-->
            <option value="">---Select---</option>
            <?php  
            

    $query = "SELECT idprs, ad, soyad FROM prisoners WHERE aktiflik='Yes' ORDER BY ad";// mahkum tablosundan veri alma
    $result1 = $conn->query($query);

    while($sonuc1 = $result1->fetch_assoc()) {
        $idprs = $sonuc1['idprs']; 
        $isim = $sonuc1['ad'] . " " . $sonuc1['soyad'];
        
         echo "<option value='" . $sonuc1['idprs'] . "'>" . $isim . "</option>";
        }
  ?>

          </select><br><br>
          <label for="visitingdate">Visiting Date:</label>
  <input type="date" name="visitingdate" id="visitingdate">
  <script>
        // JavaScript kullanarak "bugün" olarak varsayılan tarihi ayarlama
        var today = new Date();
        var dd = String(today.getDate()).padStart(2, '0');
        var mm = String(today.getMonth() + 1).padStart(2, '0'); //Ocak 0 
        var yyyy = today.getFullYear();

        today = yyyy + '-' + mm + '-' + dd;
        document.getElementById("visitingdate").value = today;
    </script>



<button id="btn-save">SAVE</button>

  </form>
 </div>
  </div>  

  <div class="right">
 
  </div>
</div>

</body>
</html>