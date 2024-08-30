<?php 

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


<b><h3 style="font-size:25px; text-align:center";>PRISON INSPECTION LIST</h3></b><!-- Muayene listesi -->
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
		<th>Name</th>
    <th>Surname</th>
    <th>İnspection Date</th>
    <th>İnspection Time</th>
		<th></th>
		
	</tr>
	


<?php 
if ($_POST) { // Sayfada post olup olmadığını kontrol ediyoruz.
  $date=$_POST['visitingdate'];

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
} 
// Bağlantıyı kapat
$conn->close();
?>

</table>
<table><tr><td><a href="healthadd.php" ><input type="submit" class="btn-edit" value="NEW INSPECTION"></a></td></tr></table>
<button onclick="topFunction()" id="myBtn" title="Go to top">Go to Top</button>

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