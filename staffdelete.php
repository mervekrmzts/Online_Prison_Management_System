<?php 
session_start();
include "session.php";
include "config.php";
$getid=$_GET['id'];
$guvenlikderecesi=2;

if ($_SESSION['security'] > $guvenlikderecesi){
 $alert="<script>alert('You are not authorized to enter this page...');</script>";
echo $alert;
echo "<script>window.location.href = 'dashboard.php';</script>";
exit();
}

$sorgu = $conn->query("SELECT id, ad, soyad FROM staffs WHERE id=".$getid); // Staffs tablosundaki ilgili veriyi çekme
$sonuc = $sorgu->fetch_assoc();


$id = $sonuc['id']; 
$ad = $sonuc['ad'];
$soyad = $sonuc['soyad'];



  

?>

<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<link rel="stylesheet" href="style.css">
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
  
  #idare tr:hover {
    background-color: #ddd;
}


        .login-container {
            width: 300px;
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
         .login-container h2{
            color:#8b795e;
        }

        .login-container label {
            display: block;
            margin-bottom: 8px;
        }

        .login-container input {
            width: 50%;
            padding: 8px;
            margin-bottom: 16px;
            box-sizing: border-box;
            background-color: #fff; 
        }

        .login-container button {
            width: 100%;
            padding: 10px;
            background-color: #8b795e;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .login-container button:hover {
            background-color:#cdb38b;
        }
    </style>
</head>
<body>

<div class="header">
   <?php require_once "header.php" ?>
</div>

 
  <div style="overflow:auto">
  <div class="menu">
  
  </div>

  <div class="main">
  <div class="login-container"><?php echo "Are you sure you want to delete the record named "; ?><b> <?php echo $ad . " " . $soyad  ;?>?</b></h3><br><br>
  
  <form method="POST" action="">
<input type="hidden" name="id" value="<?php echo $id; ?>">
<button type="submit" name="delete">DELETE</button>
  </form>
  <br><button type="button" onclick="window.location.href='staffs.php';">CANCEL</button>
  </div>
  </div>  

  <div class="right">
    <!--Sağ Menü -->
  </div>
</div>

</body>
</html>
<?php
if ($_POST) { 
  
    unlink("staffpic/" .$getid .".jpg");//staffpic klasöründeki ilgili personelin varsa resmini silme
    $sorgu = $conn->query("DELETE FROM staffs WHERE id=".$getid); // Staffs tablosundaki ilgili veriyi SİLME
    //$sonuc = $sorgu->fetch_assoc();

    $conn->close();
    
    header('location:staffs.php');
}
?>