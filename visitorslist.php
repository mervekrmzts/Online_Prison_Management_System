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
<?php $date=date("Y/m/d"); ?>

<b><h3 style="font-size:25px; text-align:center";>VISITORS LIST (<?php echo $date;?>)</h3></b><!-- Muayene listesi -->
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
$date=date("Y/m/d");
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
	
    
	
<?php } 

$conn->close();
?>

</table>
<table><tr>
  <td><a href="visitoradd.php" ><input type="submit" class="btn-edit" value="NEW VISITOR"></a></td>
  <td><a href="visitors2.php" ><input type="submit" class="btn-edit" value="DATE QUERY"></a></td>
</tr></table>
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



