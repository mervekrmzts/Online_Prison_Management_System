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
   #setbuild {
    width:100%;
    border:1px solid;
    border-collapse:collapse;
   }
    
   
   #setbuild td {
   width:15%;	
   border:1px solid;
   text-align:center;
   padding: 10px;
   }
   #setbuild th{
     padding: 10px;
     height:40px;
   }
 
   #setbuild tr:nth-child(even){
    background-color:  #f2f2f2;
    
  }
  
  #setbuild tr:hover {background-color: #ddd;}

  .btn-edit{
      background-color:#4ba123;
      border-radius:3px;
      border:1px solid black;
      width:120px;
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
  /*display: none; */
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

<body>

<div class= "header">
   <?php require_once "header.php" ?>
</div>

<div style="overflow:auto">
  <div class="menu">
    <?php require_once "menu.php"; ?>
  </div>

  <div class="main">

  <?php 


$sorgu = $conn->query("SELECT oda FROM buildingdetail WHERE idbt=". $getid); // oda ismini alma
$sonuc = $sorgu->fetch_assoc();
	
$oda = $sonuc['oda']; 

?>



  <b><h3 style="font-size:25px; text-align:center";>SETTLEMENT PLAN DETAIL ( <?php echo $oda; ?>)</h3></b>
  <div class="settings">



  <table id="setbuild">
	
	<tr>
		
		<th>BUILDDING</th>
		<th>DETAIL</th>	
    <th> PERSON</th>
	</tr>
	
<?php 
//$güvenli_oda = $conn->real_escape_string($oda);

$sorgu = $conn->query("SELECT * FROM settlement WHERE sdetail='$oda'" ); // settlememt tablosundaki ilgili verileri çekme
//$sorgu = $conn->query("SELECT * FROM settlement WHERE sdetail='$güvenli_oda'");
 
	if (!$sorgu) {
        die("Sorgu başarısız: " . $conn->error);
    }
    
    // Sonucu işleyin
    while ($sonuc = $sorgu->fetch_assoc()) {
        // İşlemleri burada yapın
    
$sbuild = $sonuc['sbuild']; 
$sdetail= $sonuc['sdetail'];
$sperad = $sonuc['sperad'];
$sperid = $sonuc['sperid'];
?>

    <tr>

		<td><?php echo $sbuild;  ?></td>
		<td><?php echo $sdetail; ?></td>   
        <td><?php echo $sperad; ?></td>  
        
        <td><a href="settlementplandlt.php?id=<?php echo $sperid; ?>" ><input type="submit" class="btn-dlt" value="DELETE"></a></td> 
		    
	</tr>
	
    
	
<?php 

} ?>

</table>
  
 </div>
 <table><tr><td><a href="settlementplan.php" ><input type="submit" class="btn-edit" value="NEW PLAN"></a></td></tr></table>
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