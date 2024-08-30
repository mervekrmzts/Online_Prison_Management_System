<?php 
session_start();
include "session.php";
include "config.php";

//uyruğa göre şehir listesini listeleme

// İlk combobox'tan seçilen ürünün ID'sini al
$selected_product_id = $_GET['product_id'];
// Seçilen ürüne ait verileri veritabanından al
$sql = "SELECT * FROM cities WHERE country_id = $selected_product_id";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // İkinci combobox için seçenekleri oluştur
    echo "<select id='second_combobox'>";
    echo "<option value='"."0"."'>"."---Select---"."</option>";
    while($row = $result->fetch_assoc()) {
        echo "<option value='".$row['city']."'>".$row['city']."</option>";
    }
    echo "</select>";
} else {
    echo "0 sonuç";
}

$conn->close();
?>
