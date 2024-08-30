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
        $sorgu2 = $conn->query("SELECT cinsiyet, resim FROM staffs WHERE id =".$getid); // staffslist ekranından alınan id değeri ile düzenlenecek verileri veritabanından alma
        $sonuc2 = $sorgu2->fetch_assoc(); 
       
if ($sonuc2['resim']!=""){ ?>
    <center><img src="<?php echo $sonuc2['resim']; ?>" class="resim" alt="Staff" width="140" height ="180"></center>
    <?php }elseif($sonuc2['resim']=="" && $sonuc2['cinsiyet']=="Man"){ ?>
       <center><img src="staffpic/ves.jpg" class="resim" alt="Staff" width="140" height ="180"></center> 
    <?php }elseif($sonuc2['resim']=="" && $sonuc2['cinsiyet']=="Woman") { ?>
       <center><img src="staffpic/ves2.jpg" class="resim" alt="Staff" width="140" height ="180"></center> 
    <?php } ?>
    
 
    <a href="staffpicupload.php?id=<?php echo $getid; ?>" align="center">UPLOAD</a><br>
    
   
    
        </td>
    </tr>
</table>

       </div> 
    </body>
    </html>