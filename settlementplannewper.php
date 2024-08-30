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

$sorgu2 = $conn->query("SELECT * FROM buildingdetail WHERE idbt=".$getid); 
$sonuc2 = $sorgu2->fetch_assoc(); //sorgu çalıştırılıp veriler alınıyor
$binaid=$sonuc2['binaid'];
$oda=$sonuc2['oda'];

$sorgu = $conn->query("SELECT bina FROM building WHERE idb=".$binaid); 
$sonuc = $sorgu->fetch_assoc(); //sorgu çalıştırılıp veriler alınıyor
$bina=$sonuc['bina'];

if ($_POST) { // Sayfada post olup olmadığını kontrol ediyoruz
 
    //Aynı kişinin ikinci kez kayıt yapılmasını engelleme
$sorgu5 = $conn->query("SELECT * FROM settlement WHERE sperid=".$_POST['pristaf']); 
$sonuc5 = $sorgu5->fetch_all(MYSQLI_ASSOC); 
if (count($sonuc5) >= 1) {
    $alert="<script>alert('The person is already registered');</script>";
    echo $alert;
    echo "<script>window.location.href = 'settlementplan.php';</script>";
    exit();
}


    
	
    if ($binaid<=2){// koğuşda kalacak mahkum kaydedilecek
        

        $build = $_POST['bina'];//bina adı
	    $detail = $_POST['oda']; // oda adı
        $sperid = $_POST['pristaf'];//mahkum id
        $sorgu3 = $conn->query("SELECT ad, soyad FROM prisoners WHERE idprs=".$sperid); 
        $sonuc3 = $sorgu3->fetch_assoc(); //sorgu çalıştırılıp veriler alınıyor
        $isim = $sonuc3['ad'] . " " . $sonuc3['soyad']; //mahkum ad soyad
        $prisonstaf="P";
        

           
        if ($sperid!="") { //  mahkum seçilmişse işlem yapılacak
       
            // kayıt işlemi
            if ($conn->query("INSERT INTO settlement (sbuild, sdetail, sperid, sperad, prisonstaf) VALUES ('$build', '$detail', '$sperid', '$isim', '$prisonstaf')"))
             {
                
             }
             else
             {
                echo mysqli_error($conn);
             }//kayıt sonu
    
        } //  mahkum seçilmişse işlem yapılacak sonu

    }else{//odalarda kalacak ya da odaların sorumlusu personel kaydedilecek
       

      
        $build = $_POST['bina'];//bina adı
	    $detail = $_POST['oda']; // oda adı
        $sperid = $_POST['pristaf'];//personel id
        $sorgu4 = $conn->query("SELECT ad, soyad FROM staffs WHERE id=".$sperid); 
        $sonuc4 = $sorgu4->fetch_assoc(); //sorgu çalıştırılıp veriler alınıyor
        $isim=$sonuc4['ad'] . " " . $sonuc4['soyad']; //personel ad soyad
        $prisonstaf="S";




           
        if ($sperid!="") { //  personel seçilmişse işlem yapılacak
       
            // kayıt işlemi
            if ($conn->query("INSERT INTO settlement (sbuild, sdetail, sperid, sperad, prisonstaf) VALUES ('$build', '$detail', '$sperid', '$isim', '$prisonstaf')") )
            {
                
             
            }
            else
            {
                echo mysqli_error($conn);
            }//kayıt sonu
    
        } //  personel seçilmişse işlem yapılacak sonu




    } // mahkum personel kontrolu sonu
   
   

	
    // Bağlantıyı kapat
   //$conn->close();

   header('Location:settlementplan.php');
} //Sayfada post olup olmadığını kontrol etme ve kapatma

?>



<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<link rel="stylesheet" href="style.css">
<style>
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
            background-color:#cdb38b;


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
  <b><h3 style="font-size:25px; text-align:center";>SETTLEMENT PLAN (NEW PERSON)</h3></b>
  <div class="settings">



  <form action="" method="POST">
  <label for="building">Building:</label>
  <input type="text"  name ="bina1" disabled value="<?php echo $bina; ?>"><!--disabled textin değeri alınamıyor hidden text ile alınacak-->
  <input type="hidden" name="bina" value="<?php echo $bina; ?>">

  <label for="build">Detail:</label><!-- bina bilgisini alma-->
  <input type="text"  name="oda1" disabled value="<?php echo $oda; ?>"><!--disabled textin değeri alınamıyor hidden text ile alınacak-->
  <input type="hidden" name="oda" value="<?php echo $oda; ?>">


  <label for="pristaf">Prison / Staff Name:</label><!--Personel ya da mahkum bilgisini alma-->

  <select id="pristaf" class="combo" name="pristaf"><!--Binalar-->
            <option value="">---Select---</option>
            <?php  
            
if ($binaid<=2){
    $query = "SELECT idprs, ad, soyad FROM prisoners WHERE aktiflik='Yes' ORDER BY ad";// mahkum tablosundan veri alma
    $result1 = $conn->query($query);

    while($sonuc1 = $result1->fetch_assoc()) {
        $idprs = $sonuc1['idprs']; 
        $isim = $sonuc1['ad'] . " " . $sonuc1['soyad'];
        
         echo "<option value='" . $sonuc1['idprs'] . "'>" . $isim . "</option>";
        }


}else{
    $query = "SELECT id, ad, soyad FROM staffs WHERE aktiflik='Yes' ORDER BY ad";// personel tablosundan veri alma
    $result2 = $conn->query($query);

    while($sonuc2 = $result2->fetch_assoc()) {
        $id = $sonuc2['id'];
        $isim = $sonuc2['ad'] . " " . $sonuc2['soyad'];
        echo "<option value='" . $sonuc2['id'] . "'>" . $isim . "</option>";
        }



}
           


  ?>
          </select><br>




 <button id="btn-save">SAVE</button>

  </form>
 </div>
  </div>  
  
  <div class="right">
  <?php require_once "men.php"; ?>
  </div>
</div>

</body>
</html>
