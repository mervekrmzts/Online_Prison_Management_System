<?php 
session_start();
include "session.php";
include "config.php"; 
$guvenlikderecesi=2;

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
<h2>NEW STAFF</h2>
<!--Kimlik bilgileri kısmı-->
<h3 style="font-size:12px; text-align:left";>ID Information :</h3><hr>
<form action="" method="post">
            <label for="name">Name:</label>
            <input type="text" name="name" ><!--Ad--->
            <label for="surname">Surname:</label>
            <input type="text" name="surname"><!--Soyad-->
            <label for="gender">Gender:</label>
            <select id="gender" class="combo" name="gender"><!--Cinsiyet--->
            <option value="">---Select---</option>
            <option value="Man">Man</option>
            <option value="Woman">Woman</option></select>
            <br> <br>
            <label for="fathername">Father Name:</label>
            <input type="text" name="fathername"><!--Baba adı-->
            <label for="mothername">Mother Name:</label>
            <input type="text" name="mothername"><!--Anne adı--->
            <label for="birthday">Birthday:</label>
            <input type="date" name="birthday"><!--Doğum tarihi-->
            <label for="nationality">Nationality:</label>
            <select id="first_combobox" class="combo" name="nationality"><!--Uyruk-->
                <option value="">---Select---</option>
                <option value="2">TC</option>
                <option value="1">KKTC</option></select>          
            <br> <br>
            <label for="birthplace">Birth Place:</label>
            <select id="second_combobox" class="combo" name="placeofbirth"><!--Doğum yeri--->
                <option value="">---Select---</option></select>
                <!--Uyruğa göre şehir listeleme-->
            <script>
    
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
            <!--Görev bilgileri kısmı-->
            
            <h3 style="font-size:12px; text-align:left";>Mission Information :</h3><hr>
            <label for="task">Task:</label>
            <select id="task" class="combo" name="task"><!--Görev-->
            <option value="">---Select---</option>
            <?php  
            
            $query = "SELECT gorevadi FROM tasks ORDER BY gorevprtno";// görevleri veritabanından alma

// Sorguyu çalıştır ve sonucu al
$result = $conn->query($query);

while($sonuc = $result->fetch_assoc()) {

$gorevadi = $sonuc['gorevadi'];

         echo "<option value='" . $sonuc['gorevadi'] . "'>" . $sonuc['gorevadi'] . "</option>";
     
  
     }  ?>
          </select><br><br>
          <label for="Jobdescription">Job Description</label><!--Görev  tanımı (Gardiyan ama erkekler koğuşunda görevli gibi-->
          <textarea id="jobdescription" name="jobdescription" rows="4" cols="58" placeholder="Make the job description"></textarea>
          <label for="dateofstart">Date Of Start</label>
          <input type="date" name="dateofstart"><!--Başlama tarihi-->
          <label for="employmentstatus">Employment Status</label>
          <select id="start" class="combo" name="start"><!--İşe başlama Şekli, Yeni, Nakil gibi -->
                <option value="">---Select---</option>
                <option value="New">New</option>
                <option value="Transport">Transport</option></select>          
          <br> <br>
          <label for="placeoftransfer">Place Of Transfer</label>
          <input type="text" name="placeoftransfer" placeholder="If transfer, enter"><!--Transfer ise nereden transfer olduğu (manuel giriş)-->

           <!--İletişim bilgileri kısmı-->
          <br>
          <h3 style="font-size:12px; text-align:left";>Contact Information :</h3><hr>
          <label for="phone">Phone Number</label>
          <input type="tel" id="phone" name="phone" pattern="[0-9]{3} [0-9]{3} [0-9]{4}" required /><!--Telefon-->
          <label style="font-size:9px; text-align:left;"> Eg : 123 456 7890  </label> 
          <label for="address">Address</label>
          <textarea id="address" name="address" rows="4" cols="58" placeholder="Enter the address"></textarea><!--Adres-->

           <!--Kişisel bilgiler kısmı-->
                     
          <br> <br>
          <h3 style="font-size:12px; text-align:left";>Personal Information :</h3><hr>
          <label for="phone">Marital Status</label>
           <select id="marial" class="combo" name="marial"><!--Medeni durum-->
                <option value="">---Select---</option>
                <option value="Single">Single</option>
                <option value="Married">Married</option>
                <option value="Widow">Widow</option></select><br> <br>
                <label for="spusesname">Spouse's Name And Surname</label> <!--Evli ise eş ad soyad-->
                <input type="text" name="spusesname">
                <label for="numberchild">Number Of Children</label><!--çocuk sayısı-->
                <input type="number" name="numberchild" value="0">
                <label for="aboutchild">Information About Children</label><!--çocuk bilgileri (isim doğum tarihi gibi)-->
                <textarea id="aboutchild" name="aboutchild" rows="4" cols="58" placeholder="Enter the children's name and date of birth information"></textarea>
                <label for="miscinf">Miscellaneous Information</label><!--Kişisel bilgiler-->
                <textarea id="miscinf" name="miscinf" rows="4" cols="58" placeholder="Enter various information about the personnel"></textarea>
          
           <button type="submit" id="btn-save">Save</button>
              

        </form>

</div>



  </div>  

  <div class="right">
  
  </div>
</div>

</body>
</html>

<?php 

if ($_POST) { // Sayfada post olup olmadığını kontrol ediyoruz.


//personel sicil numarası oluşturma
// Bağlantıyı kontrol 
if ($conn->connect_error) {
    die("Bağlantı hatası: " . $conn->connect_error);
}

// Persicilno değerini alma
$sql = "SELECT persicilno FROM settings";
$sonuc = $conn->query($sql);

if ($sonuc->num_rows > 0) {
   
    $row = $sonuc->fetch_assoc();
    $persicilno = $row["persicilno"];
    

    // Persicilno'yu bir arttırma
    $new_persicilno = $persicilno + 1;

    // yeni persicilno'yu veritabanına güncelleyelim
    $update_sql = "UPDATE settings SET persicilno=$new_persicilno";
    if ($conn->query($update_sql) === TRUE) {
       
    } else {
        echo "Hata oluştu: " . $conn->error;
    }
} else {
    echo "Persicilno bulunamadı";
}

if ($_POST['nationality']==2) {
    $uyr="TC";
}else{
    $uyr="KKTC";
    }
	

// Sayfa yenilendikten sonra post edilen değerleri değişkenlere atıyoruz
         
    $psn= "OP".$persicilno;// Online Prison kısaltması olan OP u sicilnonun başına getirme
	$ad = $_POST['name']; 
	$soyad = $_POST['surname'];
    $cinsiyet=$_POST['gender'];
    $babaadi = $_POST['fathername'];
    $anneadi = $_POST['mothername'];
    $dogumtarihi = $_POST['birthday'];
    $uyruk = $uyr;
    $dogumyeri = $_POST['placeofbirth'];
    $gorev = $_POST['task'];
    $gorevtanim = $_POST['jobdescription'];
    $baslamatarih = $_POST['dateofstart'];
    $baslamasekil = $_POST['start'];
    $transferyeri = $_POST['placeoftransfer'];
    $tlf = $_POST['phone'];
    $adres = $_POST['address'];
    $medenidurum = $_POST['marial'];
    $esadsoyad = $_POST['spusesname'];
    $cocuksayi= $_POST['numberchild'];
    $cocukbilgi= $_POST['aboutchild'];
    $kisibilgi= $_POST['miscinf'];
    $aktiflik= "Yes";

	if ($ad!="" && $soyad!="") { // Personel bilgisi için en önemli veri alanlarının boş olmadığını kontrol etme. başka kontrollerde yapabilir
		
       
		if ($conn->query("INSERT INTO staffs (persicilno, ad, soyad, cinsiyet, babaadi, anneadi, dogumtarihi, uyruk, dogumyeri, gorev, gorevtanim, baslamatarih, baslamasekil, transferyeri, tlf, adres, medenidurum, esadsoyad, cocuksayi, cocukbilgi, kisibilgi, aktiflik) VALUES ('$psn', '$ad', '$soyad', '$cinsiyet', '$babaadi','$anneadi','$dogumtarihi', '$uyruk', '$dogumyeri', '$gorev', '$gorevtanim', '$baslamatarih', '$baslamasekil', '$transferyeri', '$tlf', '$adres', '$medenidurum', '$esadsoyad', '$cocuksayi', '$cocukbilgi', '$kisibilgi', '$aktiflik')")) // Veri ekleme 
		{
			
		}
		else
		{
        	echo mysqli_error($conn);
		}

	}
    // Bağlantıyı kapat
    $conn->close();

}

?>