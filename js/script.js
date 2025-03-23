function printQRCode() {
    var qrData = "Your QR Code Data Here"; // QR kodu içeriği

    // qrcode-generator kullanarak QR kodunu oluşturun
    var typeNumber = 4; // QR kodu tipi (1 ile 40 arasında bir sayı)
    var errorCorrectionLevel = 'L'; // Hata düzeltme seviyesi ('L', 'M', 'Q', 'H')
    var qr = qrcode(typeNumber, errorCorrectionLevel);
    qr.addData(qrData);
    qr.make();

    // Oluşturulan QR kodunu resim olarak alın
    var imageDataUri = qr.createDataURL();

    // Yeni bir pencere açın ve QR kodunu bu pencerede gösterin
    var printWindow = window.open('', '_blank');
    printWindow.document.write('<html><head><title>QR Code</title></head><body>');
    printWindow.document.write('<img src="' + imageDataUri + '" alt="QR Code">');
    printWindow.document.write('<script>window.onload = function() { window.print(); window.onafterprint = function() { window.close(); } }</script>');
    printWindow.document.write('</body></html>');
}


var selectedValues = [];

var kontrol = false;

const secimbtn = document.getElementById("secim-btn");

secimbtn.addEventListener("click", function () {
    var checkboxes = document.querySelectorAll(".check");

    if (kontrol == false) {
        checkboxes.forEach(function (checkbox) {
            checkbox.style.display = "inline";
        });
        kontrol = true;
    } else {
        checkboxes.forEach(function (checkbox) {
            checkbox.style.display = "none";
        });
        kontrol = false;
    }

});



var selectedValues = [];

document.addEventListener('DOMContentLoaded', function () {
    var checkboxes = document.querySelectorAll(".check");

    checkboxes.forEach(function (checkbox) {
        checkbox.addEventListener('change', function () {
            if (checkbox.checked) {
                selectedValues.push(checkbox.value);
            }
        });
    });
});




document.addEventListener('keydown', function(event) {
    if (event.key === 'Enter') {
        event.preventDefault(); // Enter tuşunun varsayılan davranışını engelle
        postMetin(); // Enter tuşuna basıldığında metni ekleyin
    }
});



function postMetin() {
    var metinIcerik = document.getElementById("metinGirisi").value;

    if (metinIcerik) {
        var xhr = new XMLHttpRequest();
        xhr.open("POST", "ekle.php", true);
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

        xhr.onreadystatechange = function() {
            if (xhr.readyState === 4 && xhr.status === 200) {
                console.log(xhr.responseText);
                window.location.reload(); // Sayfayı yeniden yükle
            }
        };

        xhr.send("qrcode=" + metinIcerik);
    }
}


const body = document.getElementById("body")
var metinGirisi = document.getElementById("metinGirisi");
body.addEventListener("click", function () {
    metinGirisi.focus();
});
