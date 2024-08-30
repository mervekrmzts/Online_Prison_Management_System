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

.sett {
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
        .sett h2{
            color:#8b795e;
        }

        .sett label {
            display: block;
            margin-bottom: 8px;
        }

        .sett input {
            width: 100%;
            padding: 5px;
            margin-bottom: 16px;
            box-sizing: border-box;
            background-color: #fff; 
        }
        .combo{
            padding:4px;
        }

        .sett #btn-save {
            width: 100%;
            padding: 10px;
            margin:10px;
            background-color: #8b795e;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        
        }


        .sett #btn-save:hover {
            background-color:#cdb38b;
        }
        .sett a: hover{
          background-color:#cdb38b;
        
        }


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

<body>

<div class= "header">
   <?php require_once "header.php" ?>
</div>

<div style="overflow:auto">
  <div class="menu">
    <?php require_once "menu.php"; ?>
  </div>

  <div class="main">
  <b><h3 style="font-size:25px; text-align:center";>SETTINGS BUILDING (DETAIL)</h3></b>
  <div class="sett">

  <form action="" method="POST">

  <label for="building">Building:</label>
            <select id="building" class="combo" name="building"><!--Binalar-->
            <option value="">---Select---</option>
            <?php  
            
            $query = "SELECT idb, bina FROM building";// görevleri veritabanından alma

// Sorguyu çalıştır ve sonucu al
$result = $conn->query($query);

while($sonuc = $result->fetch_assoc()) {
$id = $sonuc['idb'];
$binadi = $sonuc['bina'];

         echo "<option value='" . $sonuc['idb'] . "'>" . $sonuc['bina'] . "</option>";
     
  
     }  ?>
          </select><br>
 <button id="btn-save">LIST</button>

  </form>
  </div>
  <div class="settings">

  <table id="setbuild">
	
	<tr>
		<th>BUILDING</th>
    <th>DETAIL</th>
		<th></th>		
	</tr>
	
<?php 

if ($_POST) { // Sayfada post olup olmadığını kontrol ediyoruz.

  


  $sorgu = $conn->query("SELECT bt.idbt, bt.binaid, bt.oda, b.idb, b.bina 
  FROM buildingdetail as bt
  INNER JOIN building as b ON bt.binaid = b.idb AND bt.binaid=".(int)$_POST['building']);// comboboxa göre verileri çekme
                                                    
if (!$sorgu) {
  die("Sorgu hatası: " . $conn->error);
}


}else{

  $sorgu = $conn->query("SELECT bt.idbt, bt.binaid, bt.oda, b.idb, b.bina 
  FROM buildingdetail as bt
  INNER JOIN building as b ON bt.binaid = b.idb"); // ilk açılışta buildingdetail tablosundaki tüm verileri çekme (açılışta post yok)
}
while ($sonuc = $sorgu->fetch_assoc()) { 
	
$id = $sonuc['idbt']; 
$bina = $sonuc['bina'];
$oda = $sonuc['oda'];

?>

    <tr>
		
		<td><?php echo $bina; ?></td> 
    <td><?php echo $oda;  ?></td>
    <td><a href="settingsbuilddetedit.php?id=<?php echo $id; ?>" ><input type="submit" class="btn-edit" value="EDIT"></a></td>
    <td><a href="settingsbuilddetdlt.php?id=<?php echo $id; ?>" ><input type="submit" class="btn-dlt" value="DELETE"></a></td>
			    
	</tr>
	
    
	
<?php 

} ?>

</table>
  
 </div>
 <table><tr>
<td>
  
<form method="post" action="">
<input type="submit" class="btn-edit" value="LIST ALL">
</form>

</td>
<td><a href="settingsbuilddetadd.php" ><input type="submit" class="btn-edit" value="NEW DETAIL"></a></td>
</tr></table>
<button onclick="topFunction()" id="myBtn" title="Go to Top">Go to Top</button>

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
  <?php require_once "men.php"; ?>
  </div>
</div>

</body>
</html>

