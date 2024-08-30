<?php 
//session_start();
include "session.php";
include "config.php";

$guvenlikderecesi=3;

if ($_SESSION['security'] < $guvenlikderecesi || $_SESSION['security']==6){

 } else{
 $alert="<script>alert('You are not authorized to enter this page...');</script>";
echo $alert;
echo "<script>window.location.href = 'dashboard.php';</script>";
exit();
}


?>
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
      width:130px;
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

<?php $date=date("Y/m/d"); ?>
<b><h3 style="font-size:25px; text-align:center";>PRISON INSPECTION LIST ( <?php echo $date; ?>)</h3></b><!-- Muayene listesi -->
<div class="idare" style="overflow-x: auto;">

<table id="idare">
	
	<tr>
		<th>Name</th>
    <th>Surname</th>
    <th>İnspection Date</th>
    <th>İnspection Time</th>
		<th></th>
		
	</tr>
	


<?php 
$date=date("Y/m/d");
$sorgu = $conn->query("SELECT h.hid, h.mahkumid, h.muayenetarihi, muayenesaati, p.ad, p.soyad FROM health as h, prisoners as p WHERE p.aktiflik='Yes' AND muayenetarihi='$date' and h.mahkumid=p.idprs ORDER BY h.muayenetarihi, h.muayenesaati"); // health tablosundaki aktif mahkumların muayenelerini listeleme 

while ($sonuc = $sorgu->fetch_assoc()) { 
$hid = $sonuc['hid']; 	
$ad = $sonuc['ad']; 
$soyad = $sonuc['soyad'];
$muayenetarihi = $sonuc['muayenetarihi'];
$muayenesaati = $sonuc['muayenesaati'];

?>

<tr>

		<td><?php echo $ad; ?></td>
		<td><?php echo $soyad; ?></td>
		<td><?php echo $muayenetarihi; ?></td>
    <td><?php echo $muayenesaati; ?></td>   
    <td><a href="healthedit.php?id=<?php echo $hid; ?>" ><input type="submit" class="btn-edit" value="EDIT"></a></td>
		
		    
	</tr>
	
    
	
<?php } 

$conn->close();
?>

</table>
<table><tr><td><a href="healthadd.php" ><input type="submit" class="btn-edit" value="NEW INSPECTION"></a></td>
<td><a href="health2.php" ><input type="submit" class="btn-edit" value="DATE QUERY"></a></td>
<td><a href="health3.php" ><input type="submit" class="btn-edit" value="PRISON QUERY"></a></td></tr></table>
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



