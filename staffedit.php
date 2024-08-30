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


if ($_POST['nationality']==2) {
    $uyr="TC";
}else{
    $uyr="KKTC";
    }


// Sayfa yenilendikten sonra post edilen değerleri değişkenlere atama
         
    
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
    $ayrilistarih=$_POST['departuredate'];
    $ayrilisneden=$_POST['reason'];
    $aktiflik=$_POST['activity'];
   
   

	if ($ad<>"" && $soyad<>"") { //  başka kontrollerde yapaılabilir
       
		// Veri düzenleme sorgusu
		if ($conn->query("UPDATE staffs SET ad='$ad', soyad='$soyad', cinsiyet='$cinsiyet', babaadi='$babaadi', anneadi='$anneadi', dogumtarihi='$dogumtarihi', uyruk='$uyruk', dogumyeri='$dogumyeri', gorev='$gorev', gorevtanim='$gorevtanim', baslamatarih='$baslamatarih', baslamasekil='$baslamasekil', transferyeri='$transferyeri', tlf='$tlf', adres='$adres', medenidurum='$medenidurum', esadsoyad='$esadsoyad', cocuksayi='$cocuksayi', cocukbilgi='$cocukbilgi', kisibilgi='$kisibilgi', ayrilistarih='$ayrilistarih', ayrilisneden='$ayrilisneden',  aktiflik='$aktiflik' WHERE id=".$getid)) 
		{
            
         
		}
		else
		{
        	echo mysqli_error($conn);
		}

	}
    // Bağlantıyı kapat
   //$conn->close();

   
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
<h2>STAFF EDIT</h2>

<?php 

$sorgu = $conn->query("SELECT * FROM staffs WHERE id =".$getid); // staffslist ekranından alınan id değeri ile düzenlenecek verileri veritabanından alma
$sonuc = $sorgu->fetch_assoc(); 

?>


<!--Kimlik bilgileri kısmı-->
<h3 style="font-size:12px; text-align:left";>ID Information :</h3><hr>
<form action="" method="post">
            <label for="name">Name:</label>
            <input type="text" name="name" value="<?php echo $sonuc['ad']; ?>">
            <label for="surname">Surname:</label>
            <input type="text" name="surname" value="<?php echo $sonuc['soyad']; ?>">
            <label for="gender">Gender:</label>
            <select id="gender" class="combo" name="gender">
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
            <input type="text" name="fathername" value="<?php echo $sonuc['babaadi']; ?>">
            <label for="mothername">Mother Name:</label>
            <input type="text" name="mothername" value="<?php echo $sonuc['anneadi']; ?>">
            <label for="birthday">Birthday:</label>
            <input type="date" name="birthday"  value="<?php echo $sonuc['dogumtarihi']; ?>">
            <label for="nationality">Nationality:</label>
            <select id="first_combobox" class="combo" name="nationality">
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
            <select id="second_combobox" class="combo" name="placeofbirth">
                <option value="">---Select---</option>
                <option value="<?php echo $sonuc['dogumyeri']; ?>" selected><?php echo $sonuc['dogumyeri']; ?></option></select>
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
            <!--Görev bilgileri kısmı-->
            
            <h3 style="font-size:12px; text-align:left";>Mission Information :</h3><hr>
            <label for="task">Task:</label>
            <select id="task" class="combo" name="task">
            <option value="">---Select---</option>
            <?php  
            $query = "SELECT gorevadi FROM tasks ORDER BY gorevprtno";

            // Sorguyu çalıştır ve sonucu al
          $result = $conn->query($query);

            while($gorev = $result->fetch_assoc()) {
            



 

//<!-- Yukarıda tanıttığımız gibi alanları dolduruyoruz. -->
     if ($gorev['gorevadi']==$sonuc['gorev']){
       echo "<option selected  value='" . $gorev['gorevadi'] . "'>" . $gorev['gorevadi'] . "</option>";
     }else{
       echo "<option value='" . $gorev['gorevadi'] . "'>" . $gorev['gorevadi'] . "</option>";
     }
       
    
     }  ?>
                             
            
          </select><br><br>
          <label for="Jobdescription">Job Description</label>
          <textarea id="jobdescription" name="jobdescription" rows="4" cols="58"><?php echo $sonuc['gorevtanim']; ?></textarea>
          <label for="dateofstart">Date Of Start</label>
          <input type="date" name="dateofstart" value="<?php echo $sonuc['baslamatarih']; ?>">
          <label for="employmentstatus">Employment Status</label><!--İşe başlama Şekli, Yeni, Nakil gibi -->
          <select id="start" class="combo" name="start">
                <option value="">---Select---</option>
             <?php if ($sonuc['baslamasekil']=="New"){ ?>
                <option selected value="New">New</option>
                <option value="Transport">Transport</option>
             <?php }else{ ?>
                <option value="New">New</option>
                <option selected value="Transport">Transport</option>
            <?php } ?>
                </select>          
          <br> <br>
          <label for="placeoftransfer">Place Of Transfer</label>
          <input type="text" name="placeoftransfer" placeholder="If transfer, enter" value="<?php echo $sonuc['transferyeri']; ?>">
          <label for="departuredate">Departure Date</label>
          <input type="date" name="departuredate" value="<?php echo $sonuc['ayrilistarih']; ?>"><!--Ayrılış tarihi-->
          <label for="reasonforleaving">Reason For Leaving</label><!--Ayrılış nedeni-->
          <select id="reason" class="combo" name="reason">
                <option value="">---Select---</option>
             <?php if ($sonuc['ayrilisneden']=="Resignation"){ ?>
                <option selected value="Resignation">Resignation</option><!--Emeklilik-->
                <option value="Pension">Pension</option><!--İstifa-->
                <option value="Suspension">Suspension</option><!--İşten uzaklaştırma-->
              
            <?php } elseif($sonuc['ayrilisneden']=="Pension"){ ?>
                <option value="Resignation">Resignation</option>
                <option selected value="Pension">Pension</option>
                <option value="Suspension">Suspension</option>
            
            <?php } elseif($sonuc['ayrilisneden']=="Suspension"){ ?>
                <option value="Resignation">Resignation</option>
                <option value="Pension">Pension</option>
                <option selected value="Suspension">Suspension</option>
           
            <?php } else{ ?>
                <option value="Resignation">Resignation</option>
                <option value="Pension">Pension</option>
                <option value="Suspension">Suspension</option>
            <?php } ?>

                </select>  <br><br>
                <label for="activity">Activity</label>
                <select id="activity" class="combo" name="activity"><!--Aktiflik durumu (Çalışan Yes, Çalışmayan No-->
            <?php if ( $sonuc['aktiflik']=="Yes"){ ?>
                <option selected value="Yes">Yes</option>
                <option value="No">No</option>
                <?php }else{ ?>
                <option value="Yes">Yes</option>
                <option selected value="No">No</option>
                <?php } ?>
                </select>  <br><br>
          

           <!--İletişim bilgileri kısmı-->
          <br>
          <h3 style="font-size:12px; text-align:left";>Contact Information :</h3><hr>
          <label for="phone">Phone Number</label>
          <input type="tel" id="phone" name="phone" value ="<?php echo $sonuc['tlf']; ?>" pattern="[0-9]{3} [0-9]{3} [0-9]{4}" required />
          <label style="font-size:9px; text-align:left;"> Eg : 123 456 7890  </label> 
          <label for="address">Address</label>
          <textarea id="address" name="address" rows="4" cols="58" placeholder="Enter the address"><?php echo $sonuc['adres']; ?></textarea>

           <!--Kişisel bilgiler kısmı-->
                     
          <br><br>
          <h3 style="font-size:12px; text-align:left";>Personal Information :</h3><hr>
          <label for="phone">Marital Status</label>
           <select id="marial" class="combo" name="marial">
           <?php if  ($sonuc['medenidurum']=="Single"){ ?>
                <option value="">---Select---</option>
                <option selected value="Single">Single</option>
                <option value="Married">Married</option>
                <option value="Widow">Widow</option> 
                <?php }elseif ($sonuc['medenidurum']=="Married"){ ?>
                <option value="">---Select---</option>
                <option value="Single">Single</option>
                <option selected value="Married">Married</option>
                <option value="Widow">Widow</option>  
                <?php } else{ ?> 
                <option value="">---Select---</option>
                <option value="Single">Single</option>
                <option value="Married">Married</option>
                <option selected value="Widow">Widow</option> 
                <?php } ?>       
            </select><br> <br>
                <label for="spusesname">Spouse's Name And Surname</label>
                <input type="text" name="spusesname" value="<?php echo $sonuc['esadsoyad']; ?>">
                <label for="numberchild">Number Of Children</label>
                <input type="number" name="numberchild" value="<?php echo $sonuc['cocuksayi']; ?>">
                <label for="aboutchild">Information About Children</label>
                <textarea id="aboutchild" name="aboutchild" rows="4" cols="58" placeholder="Enter the children's name and date of birth information"><?php echo $sonuc['cocukbilgi']; ?></textarea>
                <label for="miscinf">Miscellaneous Information</label>
                <textarea id="miscinf" name="miscinf" rows="4" cols="58" placeholder="Enter various information about the personnel"><?php echo $sonuc['kisibilgi']; ?></textarea>
                         
              <button type="submit" id="btn-save">Edit</button>
              

        </form>

</div>



  </div>  

  <div class="right">
  <?php include "staffsmenu2.php"; ?>
  </div>
</div>

</body>
</html>

