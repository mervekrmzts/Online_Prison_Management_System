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
  <?php// include "visitorsdatelist.php"; ?>
  <?php 
//session_start();
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


<b><h3 style="font-size:25px; text-align:center";>VISITORS LIST</h3></b><!-- Muayene listesi -->
<div class="settings">
<form action="" method="POST">
<label for="visitingdate">Date:</label>
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
<button id="btn-save">LIST</button>

  </form>


</div>
<div class="idare" style="overflow-x: auto;">
<table id="idare">
	
	<tr>
		<th>Visitor Name</th>
    <th>Prison Name</th>
    <th>Visiting Date</th>
    <th>Start Time</th>
    <th>Finish Time</th>
    <th>Conclusion</th>
	<th></th>
		
	</tr>
	


<?php 
if ($_POST) { // Sayfada post olup olmadığını kontrol ediyoruz.
$date=$_POST['visitingdate'];

$sorgu = $conn->query("SELECT v.vid, v.ziyaretci, v.mahkid, v.ziyarettarihi, v.baslamasaati, v.bitissaati, v.sonuc, p.ad, p.soyad FROM visitors as v, prisoners as p WHERE v.mahkid=p.idprs AND ziyarettarihi='$date' ORDER BY v.ziyarettarihi, v.baslamasaati"); // visitor tablosundaki ziyaretleri listeleme 

while ($sonuc = $sorgu->fetch_assoc()) { 
$vid = $sonuc['vid']; 	
$ziyaretci = $sonuc['ziyaretci']; 
$mahkum = $sonuc['ad'] . " " . $sonuc['soyad'];
$ziyarettarihi = $sonuc['ziyarettarihi'];
$baslamasaati = $sonuc['baslamasaati'];
$bitissaati = $sonuc['bitissaati'];
$netice = $sonuc['sonuc'];
?>

<tr>

		<td><?php echo $ziyaretci; ?></td>
		<td><?php echo $mahkum; ?></td>
		<td><?php echo $ziyarettarihi; ?></td>
    <td><?php echo $baslamasaati; ?></td> 
    <td><?php echo $bitissaati; ?></td> 
    <td><?php echo $netice; ?></td>
    <td><a href="visitoredit.php?id=<?php echo $vid; ?>" ><input type="submit" class="btn-edit" value="EDIT"></a></td>
				    
	</tr>
	
    
	
<?php
}
} 
// Bağlantıyı kapat
$conn->close();
?>

</table>
<table><tr>  <td><a href="visitoradd.php" ><input type="submit" class="btn-edit" value="NEW VISITOR"></a></td></tr></table>
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

  </div>  

  <div class="right">
      
   </div>
</div>

</body>
</html>