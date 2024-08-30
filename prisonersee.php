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


?>

<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="style.css">

<style>
#areatext{
  background-color:#e8e8e8;
}

#resim {

  vertical-align: top  ;
}
</style>
</head>
<?php include "config.php" ?>
<body>

<div class= "header">
   <?php include "header.php" ?>
</div>
 
<div style="overflow:auto">
  <div class="menu">
    <?php include "menu.php"; ?>
  </div>

  <div class="main">
   <div class="prisoners"></div>

   <?php 

//$sorgu=$conn->query("SELECT p.*, s.sdetail FROM prisoners AS p, settlement AS s  WHERE p.idprs=s.sperid AND s.prisonstaf='P' AND p.aktiflik='Yes' ORDER BY p.ad, p.soyad");
$sorgu = $conn->query("SELECT * FROM prisoners WHERE idprs =".$getid);

$sonuc = $sorgu->fetch_assoc(); 

$persicilno=$sonuc['mahsicilno'];
$ad=$sonuc['ad'];
$soyad=$sonuc['soyad'];
$cinsiyet=$sonuc['cinsiyet'];
$babaadi=$sonuc['babaadi'];
$anneadi=$sonuc['anneadi'];
$dogumtarihi=$sonuc['dogumtarihi'];
$uyruk=$sonuc['uyruk'];
$dogumyeri=$sonuc['dogumyeri'];

$suctarihi=$sonuc['suctarihi'];
$succinsi=$sonuc['succinsi'];
$mahtarihi=$sonuc['mahtarihi'];
$mahkararno=$sonuc['mahkararno'];
$tahliyetarihi  =$sonuc['tahliyetarihi'];
//$kogus=$sonuc['sdetail'];
$avukat=$sonuc['avukat'];
$avukattlf=$sonuc['avukattlf'];
$adres=$sonuc['adres'];
$iletkisi=$sonuc['iletkisi'];
$ilettlf=$sonuc['ilettlf'];


$resim=$sonuc['resim'];
?>
<h3>Prisoner Information Form</h3>
<b><i><u><h3 style="font-size:12px; text-align:left";>Id Information :</h3></u></i></b>
<table border="1">
  <tr>
    <td>
    <form action="">
    <label for="Registration Name" style="text-align:right">Registration Name :</label>
    <label for="Registration Name" style="text-align:left"><?php echo $persicilno ?></label><br>
    <label for="Name/surname" style="text-align:right">Name / Surname :</label>
    <label for="Name/surname" style="text-align:left"> <?php echo $ad . " " . $soyad; ?></label><br>
    <label for="gender" style="text-align:right">Gender :</label>
    <label for="gender" style="text-align:left"> <?php echo $cinsiyet; ?></label><br>
    <label for="fathername" style="text-align:right">Father Name :</label>
    <label for="fathername" style="text-align:left"> <?php echo $babaadi; ?></label><br>
    <label for="mothername" style="text-align:right">Mother Name :</label>
    <label for="mothername" style="text-align:left"> <?php echo $anneadi; ?></label><br>
    <label for="birthday" style="text-align:right">Birthday :</label>
    <label for="birthday" style="text-align:left"> <?php echo $dogumtarihi; ?></label><br>
    <label for="nationality" style="text-align:right">Nationality :</label>
    <label for="nationality" style="text-align:left"> <?php echo $uyruk; ?></label><br>
    <label for="birthplace" style="text-align:right">Birth Place :</label>
    <label for="birthplace" style="text-align:left"> <?php echo $dogumyeri; ?></label><br>

    <b><i><u><h3 style="font-size:12px; text-align:left";>Forensic Information :</h3></u></i></b>

    <label for="criminalhistory" style="text-align:right">Criminal History :</label>
    <label for="criminalhistory" style="text-align:left"> <?php echo $suctarihi; ?></label><br>
    <label for="Crimetype" style="text-align:right">Crime Type:</label>
    <label for="Crimetype" style="text-align:left"> <?php echo $succinsi; ?></label><br>
    <label for="dateofconviction" style="text-align:right">Date Of Conviction :</label>
    <label for="dateofconviction" style="text-align:left"> <?php echo $mahtarihi; ?></label><br>
    <label for="ConvictionDecisionNumber" style="text-align:right">Conviction Decision Number :</label>
    <label for="ConvictionDecisionNumber" style="text-align:left"> <?php echo $mahkararno; ?></label><br>
    <label for="ReleaseDate" style="text-align:right">Release Date :</label>
    <label for="ReleaseDate" style="text-align:left"> <?php echo $tahliyetarihi; ?></label><br>
    <label for="WardName:" style="text-align:right">Ward Name :</label>
    <?php
    $sorgu2 = $conn->query("SELECT sdetail FROM settlement WHERE sperid =$getid AND prisonstaf='P'");
    $sonuc2 = $sorgu2->fetch_assoc(); 
    $kogus=$sonuc2['sdetail'];  
    
?>

    <label for="WardName:" style="text-align:left"> <?php echo $kogus; ?></label><br>
    <label for="Lawyer" style="text-align:right">Lawyer :</label>
    <label for="Lawyer" style="text-align:left"> <?php echo $avukat; ?></label><br>
    <label for="LawyerPhone" style="text-align:right">Lawyer Phone :</label>
    <label for="LawyerPhone" style="text-align:left"> <?php echo $avukattlf; ?></label><br>

    <b><i><u><h3 style="font-size:12px; text-align:left";>Contact Information :</h3></u></i></b>
    <label for="address" style="text-align:right">Address :</label><br>
    <textarea id="areatext" name="address" rows="4" cols="58" style="resize:none; border:none" background-color:gray><?php echo $sonuc['adres']; ?></textarea><br>
    <label for="Contact Person" style="text-align:right">Contact Person :</label>
    <label for="ContactPerson" style="text-align:left"> <?php echo $iletkisi; ?></label><br>
    <label for="ContactPhone" style="text-align:right">Contact Phone :</label>
    <label for="ContactPhone" style="text-align:left"> <?php echo $ilettlf; ?></label><br>
       

  </form>




      </td>
    <td id="resim"> <?php
        $sorgu = $conn->query("SELECT cinsiyet, resim FROM prisoners WHERE idprs =".$getid); // prisonerslist ekranından alınan id değeri ile düzenlenecek verileri veritabanından alma
        $sonuc = $sorgu->fetch_assoc(); 

if ($sonuc['resim']!=""){ ?>
    <center><img src="<?php echo $sonuc['resim']; ?>" class="resim" alt="Prisoner" width="140" height ="180"></center>
    <?php }elseif($sonuc['resim']=="" && $sonuc['cinsiyet']=="Man"){ ?>
       <center><img src="prisonerpic/ves.jpg" class="resim" alt="Prisoner" width="140" height ="180"></center> 
    <?php }elseif($sonuc['resim']=="" && $sonuc['cinsiyet']=="Woman") { ?>
       <center><img src="prisonerpic/ves2.jpg" class="resim" alt="Prisoner" width="140" height ="180"></center> 
    <?php } ?> </td>
    
 
  </tr>
</table>

  </div>  

  <div class="right">
   
  </div>
</div>

</body>
</html>









      </table>

      