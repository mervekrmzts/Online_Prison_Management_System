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
?>

<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<link rel="stylesheet" href="style.css">
<style>

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
  <?php// include "staffslist.php"; ?>
  <!doctype html>
<html>
<head>
<meta charset="utf-8">

<style>
	#idare {
    width:100%;
    border:1px solid;
    border-collapse:collapse;
   }
    
   
   #idare td {
   width:15%;	
   border:1px solid;
   text-align:center;
   padding: 10px;
   }
   #idare th{
     padding: 10px;
     height:40px;
   }
 
   #idare tr:nth-child(even){
    background-color:  #f2f2f2;
    
  }
  
  #idare tr:hover {background-color: #ddd;}

  .btn-edit{
      background-color:#4ba123;
      border-radius:3px;
      border:1px solid black;
      width:100px;
      height:30px;
      color:white;
    }
    .btn-edit:hover{
     background-color:#008b45;
     color:black;
    }
    
    .btn-dlt{
      background-color:#ee3b3b;
      border-radius:3px;
      border:1px solid black;
      color:white;
      width:100px;
      height:30px;
      color:white;
    }
    .btn-dlt:hover{
    background-color:#cd5555;
    color:black;
    }
    .btn-look{
      background-color:#7ac5cd;
      border-radius:3px;
      border:1px solid black;
      width:100px;
      height:30px;
      color:white;
    }
    .btn-look:hover{
    background-color:#1b8bb4;
    color:black;
    }
    #myBtn {
  /*display: none;  */
  position: fixed; 
  bottom: 20px; 
  right: 30px; 
  z-index: 99; 
  border: none; 
  outline: none; 
  background-color: red; 
  color: white; 
  cursor: pointer; 
  padding: 15px; 
  border-radius: 10px; 
  transition:all 1s linear;
}

#myBtn:hover {
  background-color: darkred;
}
</style>
</head>


<b><h3 style="font-size:25px; text-align:center";>STAFFS</h3></b>
<div class="idare" style="overflow-x: auto;">
</table>
<table><tr>
  <td><a href="staffadd.php" ><input type="submit" class="btn-edit" value="NEW STAFF"></a></td>
 
</tr></table>
<table id="idare">
	
	<tr>
		<th>Registration Number</th>
		<th>Name</th>
		<th>Surname</th>
    <th>Task</th>
		<th></th>
		<th></th>
		<th></th>
	</tr>
	

<?php 

$sql1 = $conn->query("SELECT asis FROM settings"); 
$sql1sor = $sql1->fetch_assoc(); //aktif olmayan personel listelensin mi listelenmesin mi verisini alma
$soru=$sql1sor['asis'];

if ($soru=="Yes"){
  $sorgu=$conn->query("SELECT s.id, s.persicilno, s.ad, s.soyad, s.gorev, s.aktiflik, t.gorevadi, t.gorevprtno FROM staffs AS s, tasks AS t WHERE s.gorev=t.gorevadi ORDER BY t.gorevprtno, s.ad, s.soyad");
}else{
  $cevap="Yes";
  $sorgu=$conn->query("SELECT s.id, s.persicilno, s.ad, s.soyad, s.gorev, s.aktiflik, t.gorevadi, t.gorevprtno FROM staffs AS s, tasks AS t  WHERE s.gorev=t.gorevadi AND s.aktiflik='Yes' ORDER BY t.gorevprtno, s.ad, s.soyad");
  
 
}
// Sorguyu çalıştırma ve sonucu alma

if ($sorgu) {
while($sonuc = $sorgu->fetch_assoc()) {

	
$id = $sonuc['id']; 
$psn = $sonuc['persicilno'];
$ad = $sonuc['ad'];
$soyad = $sonuc['soyad'];
$gorev=$sonuc['gorev'];
?>

    <tr>
    <td><?php echo $psn;  ?></td>
		<td><?php echo $ad; ?></td>
		<td><?php echo $soyad; ?></td>
    <td><?php echo $gorev; ?></td>  
        <td><a href="staffedit.php?id=<?php echo $id; ?>" ><input type="submit" class="btn-edit" value="EDIT"></a></td>
		<td><a href="staffdelete.php?id=<?php echo $id; ?>" ><input type="submit" class="btn-dlt" value="DELETE"></a></td>
        <td><a href="staffssee.php?id=<?php echo $id; ?>" ><input type="submit" class="btn-look" value="LOOK"></a></td>
		    
	</tr>
	    

<?php } 
} else {
  // Sorgu başarısız olduysa, hata mesajını görüntüle
  echo "Sorgu başarısız: " . $conn->error;
}

// Veritabanı bağlantısını kapat
$conn->close();


?>

</table>
<table><tr>
  <td><a href="staffadd.php" ><input type="submit" class="btn-edit" value="NEW STAFF"></a></td>
 
</tr></table>
 <button onclick="topFunction()" id="myBtn" title="Go To Top">Go to Top</button>

 <script>

function topFunction() {
  
  var scrollToTop = window.setInterval(function() {
    
    var pos = window.pageYOffset;
   
    if (pos > 0) {
      window.scrollTo(0, pos - 50); 
    } else {
      window.clearInterval(scrollToTop); 
    }
  }, 50); 
}
</script>
</div>
  </div>  

  <div class="right">
  
   </div>
</div>

</body>
</html>