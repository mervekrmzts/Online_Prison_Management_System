<?php 
session_start();
include "session.php";
include "config.php";

$guvenlikderecesi=3;

if ($_SESSION['security'] < $guvenlikderecesi || $_SESSION['security']==7){

 } else{
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
  <b><h3 style="font-size:25px; text-align:center";>FOOD LIST</h3></b>
  <div class="settings">



  <table id="setbuild">
	
	<tr>
		<th>DATE</th>
		<th>BREAKFAST</th>
    <th>LUNCH</th>
    <th>DINNER</th>
		<th></th>	
    
	</tr>
	
<?php 





$sorgu = $conn->query("SELECT * FROM nutrition"); // nutrition tablosundaki tüm verileri çekme

while ($sonuc = $sorgu->fetch_assoc()) { 
$id  = $sonuc['nutid']; 
$date = $sonuc['tarih']; 
$breakfast = $sonuc['kahvalti'];
$lunch = $sonuc['oglen'];
$dinner = $sonuc['aksam'];
?>

    <tr>

		<td><?php echo $date;   ?></td>
		<td><?php echo $breakfast; ?></td>    
        <td><?php echo $lunch; ?></td> 
        <td><?php echo $dinner; ?></td>
        <td><a href="foodlistedit.php?id=<?php echo $id; ?>" ><input type="submit" class="btn-edit" value="EDIT"></a></td>

	</tr>
	
    
	
<?php 

} ?>

</table>
  
 </div>
 <table><tr><td><a href="foodlistadd.php" ><input type="submit" class="btn-edit" value="NEW FOOD LIST"></a></td></tr></table>
 <button onclick="topFunction()" id="myBtn" title="Sayfanın en üstüne çık">Go to Top</button>

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
 
    $conn->close();
    ?>
  <div class="right">
  
  </div>
</div>

</body>
</html>