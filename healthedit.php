<?php 
session_start();
include "session.php";
include "config.php";
$getid=$_GET['id'];


$guvenlikderecesi=6;

if ($_SESSION['security'] == $guvenlikderecesi || $_SESSION['security']==0){

 } else{
 $alert="<script>alert('You are not authorized to enter this page...');</script>";
echo $alert;
echo "<script>window.location.href = 'dashboard.php';</script>";
exit();
}


if ($_POST) { // Sayfada post olup olmadığını kontrol ediyoruz.
  

  $prisonid=$_POST['prisonid'];
  $inspectiondate=$_POST['inspectiondate'];
  $inspectiontime=date('H:i');
  $complaints=$_POST['complaints'];
  $diagnosis=$_POST['diagnosis'];
  $treatment=$_POST['treatment'];

  if ($prisonid!="") { //  başka kontrollerde yapaılabilir
       
    // Veri düzenleme sorgusu
    if ($conn->query("UPDATE health SET mahkumid='$prisonid', muayenetarihi='$inspectiondate', muayenesaati='$inspectiontime', sikayet='$complaints', teshis='$diagnosis', tedavi='$treatment' WHERE hid=". $getid))
 
    {
        
     
    }
    else
    {
        echo mysqli_error($conn);
    }

}
// Bağlantıyı kapat
$conn->close();

header('Location:health.php');

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
  <b><h3 style="font-size:25px; text-align:center";>PRISONER HEALTH SYSTEM</h3></b>
  <div class="settings">

<h2>INSPECTION EDIT</h2>
<?php
$sorgu = $conn->query("SELECT * FROM health WHERE hid=". $getid); // health tablosundan ilgili veriyi alma
$sonuc = $sorgu->fetch_assoc();
	
$mahkumid = $sonuc['mahkumid'];

?>
  <form action="" method="POST">
  <label for="prisonname">Prison Name:</label>
  <select id="prisonid" class="combo" name="prisonid"><!--Mahkumlar-->
            <option value="">---Select---</option>
            <?php  
            

    $query = "SELECT idprs, ad, soyad FROM prisoners WHERE aktiflik='Yes' ORDER BY ad";// mahkum tablosundan veri alma
    $result1 = $conn->query($query);

    while($sonuc1 = $result1->fetch_assoc()) {
        $idprs = $sonuc1['idprs']; 
        $isim = $sonuc1['ad'] . " " . $sonuc1['soyad'];
      if ($mahkumid==$idprs) { 
         echo "<option selected value='" . $sonuc1['idprs'] . "'>" . $isim . "</option>";
      }else{
        echo "<option value='" . $sonuc1['idprs'] . "'>" . $isim . "</option>";
      }
        }
  ?>

          </select><br>
          <label for="inspectiondate">Inspection Date:</label>
  <input type="date" name="inspectiondate" id="inspectiondate" value="<?php echo $sonuc['muayenetarihi']; ?>">
   
<label for="complaints">Complaints:</label>
<textarea id="complaints" name="complaints" rows="4" cols="58" placeholder="Enter the complaints"><?php echo $sonuc['sikayet']; ?></textarea><!--Hastanın şikayetleri-->
<label for="diagnosis">Diagnosis:</label>
<input type="text" name="diagnosis" id="diagnosis" value="<?php echo $sonuc['teshis']; ?>"> <!--Teşhis-->
<label for="treatment">Treatment:</label>
<textarea id="treatment" name="treatment" rows="4" cols="58" placeholder="Enter the Treatment"><?php echo $sonuc['tedavi']; ?></textarea><!--Uygulanacak Tedaviler-->


<button id="btn-save">EDIT</button>

  </form>
 </div>
  </div>  

  <div class="right">
 
  </div>
</div>

</body>
</html>