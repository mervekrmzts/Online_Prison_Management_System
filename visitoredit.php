<?php 
session_start();
include "session.php";
include "config.php";
$getid=$_GET['id'];
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
  $finishtime=date('H:i');
  $netice=$_POST['conclusion'];

  if ($prisonid!="") { //  başka kontrollerde yapaılabilir
       
    // Veri düzenleme sorgusu
    if ($conn->query("UPDATE visitors SET ziyaretci='$visitorname', mahkid='$prisonid', ziyarettarihi='$visitingdate', bitissaati='$finishtime', sonuc='$netice' WHERE vid=". $getid))
 
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
<h2>VISITOR EDIT</h2>
<?php
$sorgu = $conn->query("SELECT v.*, p.ad, p.soyad FROM visitors AS v, prisoners AS p WHERE v.mahkid=p.idprs AND vid=". $getid); // visitors tablosundan ilgili veriyi alma
$sonuc = $sorgu->fetch_assoc();
$mahisim = $sonuc['ad'] . " " . $sonuc['soyad']	

?>


  <form action="" method="POST">
  <label for="visitorname">Visitor Name /Surname:</label>
  <input type="text" name="visitorname" id="visitorname" value="<?php echo $sonuc['ziyaretci'] ?>"><!--Mahkumlar-->

  <label for="prisonname">Prison Name:</label>
  <select id="prisonid" class="combo" name="prisonid"><!--Mahkumlar-->
            <option value="">---Select---</option>
            <?php  
            

    $query = "SELECT idprs, ad, soyad FROM prisoners WHERE aktiflik='Yes' ORDER BY ad";// mahkum tablosundan veri alma
    $result1 = $conn->query($query);

    while($sonuc1 = $result1->fetch_assoc()) {
        $idprs = $sonuc1['idprs']; 
        $isim = $sonuc1['ad'] . " " . $sonuc1['soyad'];
        if ($mahisim==$isim){
         echo "<option selected value='" . $sonuc1['idprs'] . "'>" . $isim . "</option>";
        }else{
            echo "<option value='" . $sonuc1['idprs'] . "'>" . $isim . "</option>";  
        }
        }
  ?>

          </select><br><br>
          <label for="visitingdate">Visiting Date:</label>
  <input type="date" name="visitingdate" id="visitingdate" value="<?php echo $sonuc['ziyarettarihi'] ?>">
  <label for="conclusion">Conclusion:</label>
  <select id="conclusion" class="combo" name="conclusion"><!--İşe başlama Şekli, Yeni, Nakil gibi -->
  <option value="">---Select---</option>
            <?php  
            

    $query = "SELECT netice FROM visitconclusion";// mahkum tablosundan veri alma
    $result1 = $conn->query($query);

    while($sonuc1 = $result1->fetch_assoc()) {
               
       if ($sonuc['sonuc']==$sonuc1['netice']){
            echo "<option selected value='" . $sonuc1['netice'] . "'>" . $sonuc1['netice'] . "</option>";  
       }else{
            echo "<option value='" . $sonuc1['netice'] . "'>" . $sonuc1['netice'] . "</option>"; 
       }
        }
  ?>

          </select><br><br>

<button id="btn-save">EDIT</button>

  </form>
 </div>
  </div>  

  <div class="right">
 
  </div>
</div>

</body>
</html>