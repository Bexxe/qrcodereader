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
    <link rel="stylesheet" href="css/iskarta.css">
</head>
<body id="arka"> 
    <nav class="navbar bg-body-tertiary fixed-top">
        <div class="container">
          <a class="navbar-brand" href="index.php"><img src="images/ARaymond_Automotive_Logo.png" alt=""></a>
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
        <div class="row mt-3">
            <div class="section mt-5 col-12">
                <div class="row mt-5">
<div class="qrcode col-10 text-center">İskartalar</div>
<div class="tarih col-2 text-center">Tarih & Saat</div>
<div id="cikti" class="cikti col-12">
<?php
error_reporting(0);
$sql = "SELECT * FROM cikti WHERE giren_renk = 'red'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
?>
<div class="row log" id="log">
    <div style="color:<?php echo $row["giren_renk"]; ?>;" class="qrcodetxt col-10 text-center" id="qrcodetxt"><?php echo $row["girenQr"]; ?></div>
    <div style="color:<?php echo $row["giren_renk"]; ?>;"class="tarihtxt col-2 text-center" id="tarihtxt"><?php echo $row["giren_tarih"] . " " . $row["giren_saat"]; ?></div>
  </div>
<?php
    }
  }
  $conn->close();
?>
                </div>
            </div>
        </div>
       </div>
       </div>
       </div>
<script src="js/script.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>
