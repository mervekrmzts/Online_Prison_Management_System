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

<body>

<div class= "header">
   <?php include "header.php" ?>
</div>
 
<div style="overflow:auto">
  <div class="menu">
    <?php include "menu.php"; ?>
  </div>

  <div class="main">
   <div class="staff"></div>

   <?php 

$sorgu = $conn->query("SELECT * FROM staffs WHERE id =".$getid); // staffslist ekranından alınan id değeri ile düzenlenecek verileri veritabanından alma
$sonuc = $sorgu->fetch_assoc(); 

$persicilno=$sonuc['persicilno'];
$ad=$sonuc['ad'];
$soyad=$sonuc['soyad'];
$cinsiyet=$sonuc['cinsiyet'];
$babaadi=$sonuc['babaadi'];
$anneadi=$sonuc['anneadi'];
$dogumtarihi=$sonuc['dogumtarihi'];
$uyruk=$sonuc['uyruk'];
$dogumyeri=$sonuc['dogumyeri'];
$gorev=$sonuc['gorev'];
$gorevtanim=$sonuc['gorevtanim'];
$baslamatarih=$sonuc['baslamatarih'];
$baslamasekil=$sonuc['baslamasekil'];
$transferyeri=$sonuc['transferyeri'];
$ayrilistarih=$sonuc['ayrilistarih'];
$ayrilisneden=$sonuc['ayrilisneden'];
$tlf=$sonuc['tlf'];
$adres=$sonuc['adres'];
$medenidurum=$sonuc['medenidurum'];
$esadsoyad=$sonuc['esadsoyad'];
$cocuksayi=$sonuc['cocuksayi'];
$cocukbilgi=$sonuc['cocukbilgi'];
$kisibilgi=$sonuc['kisibilgi'];
$resim=$sonuc['resim'];
?>
<h3>Staff Information Form</h3>
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

    <b><i><u><h3 style="font-size:12px; text-align:left";>Mission Information :</h3></u></i></b>

    <label for="task" style="text-align:right">Task :</label>
    <label for="task" style="text-align:left"> <?php echo $gorev; ?></label><br>
    <label for="jobdescription" style="text-align:right">Job Description :</label><br>
    <textarea id="areatext" name="jobdescription" rows="4" cols="58" style="resize:none; border:none" background-color:gray><?php echo $sonuc['gorevtanim']; ?></textarea><br>
    <label for="dateofstart" style="text-align:right">Date Of Start :</label>
    <label for="dateofstart" style="text-align:left"> <?php echo $baslamatarih; ?></label><br>
    <label for="employmentstatus" style="text-align:right">Employment Status :</label>
    <label for="employmentstatus" style="text-align:left"> <?php echo $baslamasekil; ?></label><br>
    <label for="placeoftransfer" style="text-align:right">Place Of Transfer :</label>
    <label for="placeoftransfer" style="text-align:left"> <?php echo $transferyeri; ?></label><br>
    <label for="departuredate" style="text-align:right">Departure Date :</label>
    <label for="departuredate" style="text-align:left"> <?php echo $ayrilistarih; ?></label><br>
    <label for="reasonforleaving" style="text-align:right">Reason For Leaving :</label>
    <label for="reasonforleaving" style="text-align:left"> <?php echo $ayrilisneden; ?></label><br>

    <b><i><u><h3 style="font-size:12px; text-align:left";>Contact Information :</h3></u></i></b>

    <label for="phonenumber" style="text-align:right">Phone Number :</label>
    <label for="phonenumber" style="text-align:left"> <?php echo $ayrilisneden; ?></label><br>
    <label for="address" style="text-align:right">Address :</label>
    <label for="address" style="text-align:left"> <?php echo $adres; ?></label><br>
    <textarea id="areatext" name="address" rows="4" cols="58" style="resize:none; border:none" background-color:gray><?php echo $sonuc['adres']; ?></textarea><br>
    
    <b><i><u><h3 style="font-size:12px; text-align:left";>Personal Information : :</h3></u></i></b>

    <label for="marialstatus" style="text-align:right">Marial Status :</label>
    <label for="marialstatus" style="text-align:left"> <?php echo $medenidurum; ?></label><br>
    <label for="spousesnameandsurname" style="text-align:right">Spouse's Name And Surname :</label>
    <label for="spousesnameandsurname" style="text-align:left"> <?php echo $esadsoyad; ?></label><br>
    <label for="numberofchildren" style="text-align:right">Number Of Children :</label>
    <label for="numberofchildren" style="text-align:left"> <?php echo $cocuksayi; ?></label><br>
    <label for="informationaboutchildren" style="text-align:left">Information About Children :</label><br>
    <textarea id="areatext" name="informationaboutchildren" rows="4" cols="58" style="resize:none; border:none" background-color:gray><?php echo $sonuc['cocukbilgi']; ?></textarea><br>
    <label for="miscellaneousinformation" style="text-align:left">Miscellaneous Information :</label><br>
    <textarea id="areatext" name="informationaboutchildren" rows="4" cols="58" style="resize:none; border:none" background-color:gray><?php echo $sonuc['kisibilgi']; ?></textarea><br>


  </form>




      </td>
      
       
        
    <td id="resim"><?php $sorgu2 = $conn->query("SELECT cinsiyet, resim FROM staffs WHERE id =".$getid); // staffslist ekranından alınan id değeri ile düzenlenecek verileri veritabanından alma
    $sonuc2 = $sorgu2->fetch_assoc(); 
   
if ($sonuc2['resim']!=""){ ?>
<center><img src="<?php echo $sonuc2['resim']; ?>" class="resim" alt="Staff" width="140" height ="180"></center>
<?php }elseif($sonuc2['resim']=="" && $sonuc2['cinsiyet']=="Man"){ ?>
   <center><img src="staffpic/ves.jpg" class="resim" alt="Staff" width="140" height ="180"></center> 
<?php }elseif($sonuc2['resim']=="" && $sonuc2['cinsiyet']=="Woman") { ?>
   <center><img src="staffpic/ves2.jpg" class="resim" alt="Staff" width="140" height ="180"></center> 
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

      