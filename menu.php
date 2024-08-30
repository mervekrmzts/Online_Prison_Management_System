
    
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="style.css">
        
    </head>
    <body>
       <div>
<table>
<tr>
    <td style="background-color:#8b795e; color:#fff; font-size:20px; text-align:center"><?php echo $_SESSION['isim']; ?></td>
    
    </tr>
    <tr>
        <td width="200">
    <!-- Ana menü-->
    <a href="administration.php">ADMINISTRATION</a>
    <a href="staffs.php">STAFFS</a>
    <a href="prisoners.php">PRISONERS</a>
    <a href="health.php">HEALTH</a>
    <a href="foodlist.php">NUTRITION</a>
    <a href="visitors.php">VISITORS</a>
    <a href="settlementplan.php">SETTLEMENT PLAN</a>
	<a href="settings.php">SETTINGS</a>
	<a href="exit.php">SAFE EXIT</a>
        </td>
    </tr>
    
</table>

       </div> 
    </body>
    </html>
    