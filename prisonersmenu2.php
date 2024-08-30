<!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="style.css">
       <style>
        .resim {
    background:transparent;
    padding:8px;
    border:1px solid #ccc;
    box-shadow:5px 5px 5px #999; 
}
       </style>    
    </head>
    <body>
       <div>
<table>
    <tr>
        <td width="250">
        <?php
        $getid=$_GET['id'];
        $sorgu = $conn->query("SELECT cinsiyet, resim FROM prisoners WHERE idprs =".$getid); // staffslist ekranından alınan id değeri ile düzenlenecek verileri veritabanından alma
        $sonuc = $sorgu->fetch_assoc(); 

if ($sonuc['resim']!=""){ ?>
    <center><img src="<?php echo $sonuc['resim']; ?>" class="resim" alt="Prisoner" width="140" height ="180"></center>
    <?php }elseif($sonuc['resim']=="" && $sonuc['cinsiyet']=="Man"){ ?>
       <center><img src="prisonerpic/ves.jpg" class="resim" alt="Prisoner" width="140" height ="180"></center> 
    <?php }elseif($sonuc['resim']=="" && $sonuc['cinsiyet']=="Woman") { ?>
       <center><img src="prisonerpic/ves2.jpg" class="resim" alt="Prisoner" width="140" height ="180"></center> 
    <?php } ?>
    
 
    <a href="prisonerpicupload.php?id=<?php echo $getid; ?>" align="center">UPLOAD</a><br>
    
   
    
        </td>
    </tr>
</table>

       </div> 
    </body>
    </html>