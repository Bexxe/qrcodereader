<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "qrcoderead";

// Veritabanı bağlantısını oluştur
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// JavaScript tarafından gönderilen veriyi al
if (isset($_POST["qrcode"])) {
    date_default_timezone_set('Europe/Istanbul');
    $veri_tarihi = date("d.m.Y");
    $veri_saat = date("H:i:s");
    $qrcode = $_POST["qrcode"];
    
    // Güvenlik: SQL enjeksiyonuna karşı koruma
    $qrcode = $conn->real_escape_string($qrcode);

    // "giris" tablosunda veriyi kontrol et
    $sql = "SELECT * FROM cikti WHERE girenQr = '$qrcode'";
    $result = $conn->query($sql);
    
    if ($result->num_rows > 0) {
        $sql2 = "UPDATE cikti SET giren_renk = 'black', cikan_renk = 'black', cikanQr='$qrcode', cikan_tarih='$veri_tarihi', cikan_saat='$veri_saat' WHERE girenQr = '$qrcode'";
        if ($conn->query($sql2) === TRUE) {
            echo "success";
        } else {
            echo "error";
        }
    } else {
        // Eğer veri "giris" tablosunda yoksa
        // "giris" tablosuna ekleyebilirsiniz ve renk sütununu "red" olarak ayarlayabilirsiniz.
        $sql = "INSERT INTO cikti (girenQr, giren_tarih, giren_saat, giren_renk, cikanQr, cikan_renk) VALUES ('$qrcode', '$veri_tarihi', '$veri_saat', 'red', 'Çıkış Yapmadı', 'red')";
        
        if ($conn->query($sql) === TRUE) {
            echo "success";
        } else {
            echo "error";
        }
    }
}
?>
