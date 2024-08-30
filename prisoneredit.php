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



if ($_POST) { // Sayfada post olup olmadığını kontrol ediyoruz.


   

	
if ($_POST['nationality']==2) {//combo value 2 ise uyruk TC
    $uyr="TC";
}else{
        $uyr="KKTC";// combo value 1 ise uyruk KKTC
    }
    

// Sayfa yenilendikten sonra post edilen değerleri değişkenlere atıyoruz
         
    
	$ad = $_POST['name']; 
	$soyad = $_POST['surname'];
    $cinsiyet=$_POST['gender'];
    $babaadi = $_POST['fathername'];
    $anneadi = $_POST['mothername'];
    $dogumtarihi = $_POST['birthday'];
    $uyruk = $uyr;
    $dogumyeri = $_POST['placeofbirth'];
    $suctarihi = $_POST['criminalhistory'];
    $succinsi = $_POST['crimetype'];
    $mahtarihi = $_POST['dateofconviction'];
    $mahkararno = $_POST['convictiondesicionnumber'];
    $tahliyetarihi = $_POST['releasedate'];
    $avukat = $_POST['lawyer'];
    $avukattlf = $_POST['lawyerphone']; 
    $adres = $_POST['adress'];
    $iletkisi = $_POST['contactperson'];
    $ilettlf= $_POST['contactphone'];
    $aktiflik= $_POST['activity'];
        

	if ($ad<>"" && $soyad<>"") { // Pmahkum bilgisi için en önemli veri alanlarının boş olmadığını kontrol etme. başka kontrollerde yapabilir
		
       
		if ($conn->query("UPDATE prisoners SET ad='$ad', soyad='$soyad', cinsiyet='$cinsiyet', babaadi='$babaadi', anneadi='$anneadi', dogumtarihi='$dogumtarihi', uyruk='$uyruk', dogumyeri='$dogumyeri', suctarihi='$suctarihi', succinsi='$succinsi', mahtarihi='$mahtarihi', mahkararno='$mahkararno', tahliyetarihi='$tahliyetarihi', avukat='$avukat', avukattlf='$avukattlf', adres='$adres', iletkisi='$iletkisi', ilettlf='$ilettlf', aktiflik='$aktiflik' WHERE idprs=". $getid)) // Veri düzenleme
		{
			
		}else{
        	echo mysqli_error($conn);
		}

	}
    

}

?>

<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<link rel="stylesheet" href="style.css">
<style>
.nstaff {
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
        .nstaff h2{
            color:#8b795e;
        }

        .nstaff label {
            display: block;
            margin-bottom: 8px;
        }

        .nstaff input {
            width: 100%;
            padding: 5px;
            margin-bottom: 16px;
            box-sizing: border-box;
            background-color: #fff; 
        }
        .combo{
            padding:4px;
        }

        .nstaff #btn-save {
            width: 100%;
            padding: 10px;
            margin:10px;
            background-color: #8b795e;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }


        .nstaff #btn-save:hover {
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
  
<div class="nstaff">
<h2>EDIT PRISONER</h2>

<?php 

$sorgu = $conn->query("SELECT * FROM prisoners WHERE idprs =".$getid); // prisoners ekranından alınan id değeri ile düzenlenecek verileri veritabanından alma
$sonuc = $sorgu->fetch_assoc(); 

?>


<!--Kimlik bilgileri kısmı-->
<h3 style="font-size:12px; text-align:left";>ID Information :</h3><hr>
<form action="" method="post">
            <label for="name">Name:</label>
            <input type="text" name="name" value="<?php echo $sonuc['ad'] ?>"><!--Ad--->
            <label for="surname">Surname:</label>
            <input type="text" name="surname" value="<?php echo $sonuc['soyad'] ?>"><!--Soyad-->
            <label for="gender">Gender:</label>
            <select id="gender" class="combo" name="gender"><!--Cinsiyet--->
            <option value="">---Select---</option>
            <?php if ($sonuc['cinsiyet']=="Man") { ?>
            <option value="Man" selected>Man</option>
            <option value="Woman">Woman</option></select>
            <?php }
            else{ ?>
            <option value="Man">Man</option>
            <option value="Woman" selected>Woman</option></select>   
            <?php }    ?>
            <br> <br>
            <label for="fathername">Father Name:</label>
            <input type="text" name="fathername" value="<?php echo $sonuc['babaadi'] ?>"><!--Baba adı-->
            <label for="mothername">Mother Name:</label>
            <input type="text" name="mothername" value="<?php echo $sonuc['anneadi'] ?>"><!--Anne adı--->
            <label for="birthday">Birthday:</label>
            <input type="date" name="birthday" value="<?php echo $sonuc['dogumtarihi'] ?>"><!--Doğum tarihi-->
            <label for="nationality">Nationality:</label>
            <select id="first_combobox" class="combo" name="nationality"><!--Uyruk-->
                <option value="">---Select---</option>
                <?php if ($sonuc['uyruk']=="TC") { ?>
                <option value="2" selected>TC</option>
                <option value="1">KKTC</option></select> 
                <?php }  
                else{ ?>
                <option value="2">TC</option>
                <option value="1" selected>KKTC</option></select> 
                <?php }  ?>         
            <br> <br>
            <label for="birthplace">Birth Place:</label>
            <select id="second_combobox" class="combo" name="placeofbirth"><!--Doğum yeri--->
                <option value="">---Select---</option>
                <option value="<?php echo $sonuc['dogumyeri']; ?>" selected><?php echo $sonuc['dogumyeri']; ?></option></select>
                <!--Uyruğa göre şehir listeleme-->
            <script>
    // İlk combobox
    var firstCombobox = document.getElementById("first_combobox");

    
    firstCombobox.addEventListener("change", function() {
      
        var selectedProductId = firstCombobox.value;

       
        var xhr = new XMLHttpRequest();
        xhr.open("GET", "veri_cek.php?product_id=" + selectedProductId, true);
        xhr.onreadystatechange = function() {
            if (xhr.readyState == 4 && xhr.status == 200) {
                
                document.getElementById("second_combobox").innerHTML = xhr.responseText;
            }
        };
        xhr.send();
    });
</script>
            
            <br>
<!--Adli bilgileri kısmı-->
<h3 style="font-size:12px; text-align:left";>Forensic Information :</h3><hr>
<label for="criminalhistory">Criminal History:</label>
<input type="date" name="criminalhistory"  value="<?php echo $sonuc['suctarihi'] ?>"><!--Suç tarihi-->
<label for="criminaltype">Crime Type:</label>
            <select id="crimetype" class="combo" name="crimetype"><!--Suç tipi-->
            <option value="">---Select---</option>
            <?php  
            
            $query = "SELECT suctipi FROM crimes order by suctipi";// suç tiplerini veritabanından alma

// Sorguyu çalıştır ve sonucu al
$result = $conn->query($query);

while($sonuc2 = $result->fetch_assoc()) {

$suctipi = $sonuc2['suctipi'];
if ($suctipi==$sonuc['succinsi']){

echo "<option selected value='" . $sonuc2['suctipi'] . "'>" . $sonuc2['suctipi'] . "</option>";
}else{
    echo "<option value='" . $sonuc2['suctipi'] . "'>" . $sonuc2['suctipi'] . "</option>";  
}   
  
     }  ?>





          </select><br><br>
<label for="dateofconviction">Date Of Conviction:</label>
<input type="date" name="dateofconviction" value="<?php echo $sonuc['mahtarihi'] ?>"><!--Mahkumiyet tarihi-->
<label for="convictiondesicionnumber">Conviction Decision Number:</label>
<input type="text" name="convictiondesicionnumber" value="<?php echo $sonuc['mahkararno'] ?>"><!--Mahkumiyet karar no-->
<label for="releasedate">Release Date:</label>
<input type="date" name="releasedate" value="<?php echo $sonuc['tahliyetarihi'] ?>"><!--tahliye tarihi-->
<label for="lawyer">Lawyer:</label>           
<input type="text" name="lawyer" value="<?php echo $sonuc['avukat'] ?>"><!--Avukatı-->
<label for="lawyerphone">Lawyer Phone:</label>           
<input type="tel" id="lawyerphone" name="lawyerphone" value="<?php echo $sonuc['avukattlf'] ?>" pattern="[0-9]{3} [0-9]{3} [0-9]{4}" required /><!--iavukat telefonu-->
<label style="font-size:9px; text-align:left;"> Eg : 123 456 7890  </label> 
<!--Kişisel bilgileri kısmı-->
<h3 style="font-size:12px; text-align:left";>Personal Information :</h3><hr>
<label for="adress">Adress:</label>
<textarea id="adress" name="adress" rows="4" cols="58" placeholder="Enter the adress"><?php echo $sonuc['adres'] ?></textarea><!--Adress-->
<label for="contactperson">Contact Person:</label>           
<input type="text" name="contactperson" value="<?php echo $sonuc['iletkisi'] ?>"><!--İrtibat kişisi-->
<label for="contactphone">Contact Phone:</label>           
<input type="tel" id="contactphone" name="contactphone" value="<?php echo $sonuc['ilettlf'] ?>" pattern="[0-9]{3} [0-9]{3} [0-9]{4}" required /><!--irtibat telefonu-->
<label style="font-size:9px; text-align:left;"> Eg : 123 456 7890  </label> 

<label for="activity">Activity</label>
                <select id="activity" class="combo" name="activity"><!--Aktiflik durumu (Çalışan Yes, Çalışmayan No-->
            <?php if ( $sonuc['aktiflik']=="Yes"){ ?>
                <option selected value="Yes">Yes</option>
                <option value="No">No</option>
                <?php }else{ ?>
                <option value="Yes">Yes</option>
                <option selected value="No">No</option>
                <?php } ?>
                </select>  <br>



            <button type="submit" id="btn-save">Edit</button>
              

        </form>

</div>



  </div>  

  <div class="right">
  <?php include "prisonersmenu2.php"; ?>
  </div>
</div>

</body>
</html>

