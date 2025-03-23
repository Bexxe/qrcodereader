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
    <link rel="stylesheet" href="css/all.css">
</head>
<body>
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
                <li class="nav-item">
                  <a class="nav-link" aria-current="page" href="index.php">Qr Code Scanner<i class="fa-solid fa-qrcode"></i></a>
                </li>
                <li class="nav-item active">
                  <a class="nav-link" aria-current="page" href="#">All QrCode <i class="fa-solid fa-qrcode"></i></a>
                </li>
              </ul>
            </div>
          </div>
        </div>
      </nav>
      <div class="container-fluid">

        <div class="row mt-5">
            <div class="search-container col-4">
                <div class="row justify-content-center mt-5">
                    <div class="search col-12">
                       <form action="" method="post">
                        <div class="search-txt text-center mt-3">
                            <input type="text" name="qrara" placeholder="Qr Code Ara">
                        </div>
                        <div class="search-txt text-center mt-3">
                            <input type="date" name="qrdate">
                        </div>
                        <div class="search-btn text-center mt-3">
                            <button name="ara" type="submit">Ara <i class="fa-solid fa-magnifying-glass"></i></button>
                        </div>
                       </form>
                    </div>
                </div>
            </div>
            <div class="section col-8">
                <div class="row justify-content-center mt-5">
                    <div class="qrcode col-8 text-center">QrCode</div>
                    <div class="tarih col-4 text-center">Date</div>
                    <div class="cikti col-12">
                    <?php
if (isset($_POST["ara"])) {
    $searchKeyword = $_POST['qrara'];
    $searchDate = $_POST['qrdate'];

if(!empty($_POST["qrara"]) && !empty($_POST["qrdate"])){
  $dateString1 = strtotime($searchDate); // This will give you a Unix timestamp
  $formattedDate1 = date("d.m.Y", $dateString1); 
 // Kullanıcıdan gelen anahtar kelimeyi içeren kullanıcıları sorgula
 $sql = "SELECT * FROM cikti WHERE Tarih LIKE '%$formattedDate1%' AND QrCode LIKE '%$searchKeyword%' ORDER BY id DESC";
 
 $result = $conn->query($sql);

 if ($result->num_rows > 0) {
     while ($row = $result->fetch_assoc()) {
         ?>
         <div class="row log">
             <div class="qrcodetxt col-8 text-center"><?php echo $row["QrCode"]; ?></div>
             <div class="tarihtxt col-4 text-center"><?php echo $row["Tarih"] . " " . $row["saat"]; ?></div>
         </div>
         <?php
     }
 } else {
  ?>
  <div class="container-fluid">
   <div class="row justify-content-center align-items-center g-2">
      <div class="eslesme col-12 text-center">
      <span class="loader"></span>
     <span class="loader-txt">Eşleşen kayıt bulunamadı</span>
      </div>
   </div>
  </div>
 <?php
 }
}
else if (empty($_POST["qrara"]) && !empty($_POST["qrdate"])){
  $dateString2 = strtotime($searchDate); // This will give you a Unix timestamp
  $formattedDate2 = date("d.m.Y", $dateString2); 
 // Kullanıcıdan gelen anahtar kelimeyi içeren kullanıcıları sorgula
 $sql = "SELECT * FROM cikti WHERE Tarih LIKE '%$formattedDate2%' AND QrCode LIKE '%$searchKeyword%' ORDER BY id DESC";
 
 $result = $conn->query($sql);

 if ($result->num_rows > 0) {
     while ($row = $result->fetch_assoc()) {
         ?>
         <div class="row log">
             <div class="qrcodetxt col-8 text-center"><?php echo $row["QrCode"]; ?></div>
             <div class="tarihtxt col-4 text-center"><?php echo $row["Tarih"] . " " . $row["saat"]; ?></div>
         </div>
         <?php
     }
 } else {
  ?>
   <div class="container-fluid">
    <div class="row justify-content-center align-items-center g-2">
       <div class="eslesme col-12 text-center">
       <span class="loader"></span>
      <span class="loader-txt">Eşleşen kayıt bulunamadı</span>
       </div>
    </div>
   </div>
  <?php
 }
}
else{
     $dateString = strtotime($searchDate); // This will give you a Unix timestamp
     $formattedDate = date("d.m.Y", $dateString); 
    // Kullanıcıdan gelen anahtar kelimeyi içeren kullanıcıları sorgula
    $sql = "SELECT * FROM cikti WHERE Tarih LIKE '%$formattedDate%' OR QrCode LIKE '%$searchKeyword%' ORDER BY id DESC";
    
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            ?>
            <div class="row log">
                <div class="qrcodetxt col-8 text-center"><?php echo $row["QrCode"]; ?></div>
                <div class="tarihtxt col-4 text-center"><?php echo $row["Tarih"] . " " . $row["saat"]; ?></div>
            </div>
            <?php
        }
    } else {
      ?>
      <div class="container-fluid">
       <div class="row justify-content-center align-items-center g-2">
          <div class="eslesme col-12 text-center">
          <span class="loader"></span>
         <span class="loader-txt">Eşleşen kayıt bulunamadı</span>
          </div>
       </div>
      </div>
     <?php
    }
  }
} 
else {
    $sql = "SELECT * FROM cikti"; // Verileri tersten sırala
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            ?>
            <div class="row log" id="log">
                <div class="qrcodetxt col-8 text-center" id="qrcodetxt"><?php echo $row["QrCode"]; ?></div>
                <div class="tarihtxt col-4 text-center" id="tarihtxt"><?php echo $row["Tarih"] . " " . $row["saat"]; ?></div>
            </div>
            <?php
        }
    }
    $conn->close();
}
?>

  
                    </div>
                </div>
            </div>
        </div>
       </div>

    <script src="js/all.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>