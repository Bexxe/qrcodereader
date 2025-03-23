<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "qrcoderead";  

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">
    <script type="text/javascript" src="js/qrcode.min.js"></script>
    <script src="https://cdn.rawgit.com/davidshimjs/qrcodejs/gh-pages/qrcode.min.js"></script>
</head>
<body id="arka"> 
    <nav class="navbar bg-body-tertiary fixed-top">
        <div class="container">
          <a class="navbar-brand" href="#"><img src="images/ARaymond_Automotive_Logo.png" alt=""></a>
          <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
            <div class="offcanvas-header">
              <h5 class="offcanvas-title" id="offcanvasNavbarLabel"></h5>
              <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
            <div class="offcanvas-body">
              <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
                <li class="nav-item active">
                  <a class="nav-link" aria-current="page" href="#">Qr Code Scanner<i class="fa-solid fa-qrcode"></i></a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" aria-current="page" href="allqrcode.php">All QrCode <i class="fa-solid fa-qrcode"></i></a>
                </li>
              </ul>
            </div>
          </div>
        </div>
      </nav>

<div class="container">
<div class="row justify-content-center align-items-center g-2">
<div class="spin-all" id="spin-all">
<div class="span-back col-12"></div>
<div class="spin col-3" id="spin">
<span class="loader"></span>
</div>
</div>
</div>  
</div>

       <div class="container-fluid">
        <div class="row mt-5">
            <div class="baslik text-center">
                <h1>Qr Code Scanner <i class="fa-solid fa-qrcode"></i></h1>
            </div>
            <div class="section mt-5 col-12">
                <div class="row justify-content-center">
                    <div class="camera col-5 text-center">
                      <form action="" method="post">
                        <div class="row">
                      <div class="qrcode-txt col-12">
                            <input name="qrcode" type="text" id="metinGirisi" oninput="kontrolEt()" onchange="metinDolduMu()" placeholder="Qr Code">
                        </div>
                        </div>
                      </form>
                    </div>
                </div>
                <canvas id="qrcodeCanvas" width="200" height="200" style="display: block;"></canvas>
                 <div class="row"> 
                 <div class="iskarta-bul col-1">
                 <form action="iskarta.php" method="post">
                <button name="iskartabtn" type="submit">Fire Bul <i class="fa-solid fa-magnifying-glass"></i></button>
                </form>
                </div>
                <div class="secim col-1">
                <button id="secim-btn" type="button">Seçim Yap <i class="fa-solid fa-check"></i></button>
                </div>
                <div class="yazdir-btn col-1">
                <button onclick="printQRCode()" id="yazdirbtn" type="button"><i class="fa-solid fa-print"></i></button>
                </div>
                <script>

    </script>
                 </div>
    <div class="row justify-content-center mt-5">
        <div class="giris-tablo col-6 me-2">
         <div class="basliklar">
            <div class="row">
                <div class="baslik-icerik col-1">
                   No
                </div>
                <div class="baslik-icerik col-7">
                    Giriş Yapan QrCode
                </div>
                <div class="baslik-icerik col-4">
                    Tarih & Saat
                </div>
            </div>
            <?php
error_reporting(0);
$sql = "SELECT * FROM cikti ORDER BY id DESC";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
?>
            <div class="row icerik-back">
                    <div class="icerik col-1 text-center" style="color:<?php echo $row["giren_renk"]; ?>;">
                    <input class="check" id="<?php echo $row["id"]; ?>" type="checkbox" value="<?php echo $row["girenQr"]; ?>"> <?php echo $row["id"]; ?>
                    </div>
                    <div class="icerik col-7 text-center" style="color:<?php echo $row["giren_renk"]; ?>;">
                    <?php echo $row["girenQr"]; ?>
                    </div>
                    <div class="icerik col-4 text-center" style="color:<?php echo $row["giren_renk"]; ?>;">
                    <?php echo $row["giren_tarih"] . " " . $row["giren_saat"]; ?>
                    </div>
            </div>
            <?php
    }
  }
?>
         </div>
        </div>
        <div class="cikis-tablo col-5">
        <div class="basliklar">
                <div class="row">
                    <div class="baslik-icerik col-8">
                    Çıkış Yapan QrCode
                    </div>
                    <div class="baslik-icerik col-4">
                        Tarih & Saat
                    </div>
                </div>
                <?php
error_reporting(0);
$sql = "SELECT * FROM cikti ORDER BY id DESC";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
?>
                <div class="row icerik-back">
                        <div class="icerik col-8 text-center" style="color:<?php echo $row["giren_renk"]; ?>;">
                        <?php echo $row["cikanQr"]; ?>
                        </div>
                        <div class="icerik col-4 text-center" style="color:<?php echo $row["giren_renk"]; ?>;">
                        <?php echo $row["cikan_tarih"] . " " . $row["cikan_saat"]; ?>
                        </div>
                </div>
                <?php
    }
  }
  $conn->close();
?>
             </div>
           </div>
    </div>
                
<script src="js/script.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>
