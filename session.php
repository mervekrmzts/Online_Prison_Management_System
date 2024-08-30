<?php


// Kullanıcı oturumunun başlangıç zamanını kontrol eder
if (isset($_SESSION['last_activity']) && (time() - $_SESSION['last_activity'] > 300)) { // 300 saniye = 5 dakika
    // Oturumu sonlandır
    session_unset();     // Oturum değişkenlerini temizler
    session_destroy();   // Oturumu sonlandırır
    $alert="<script>alert('Session Terminated...');</script>";
    echo $alert;
    echo "<script>window.location.href = 'exit.php';</script>";
   
    exit(); // Kodun devamını engeller
}

// Kullanıcının son etkinlik zamanını günceller
$_SESSION['last_activity'] = time();
?>