// SVG oluşturma fonksiyonu
function createSVG() {
    const svgContainer = document.getElementById('svg-container');
    const svgNS = "http://www.w3.org/2000/svg";
    
    const svgElement = document.createElementNS(svgNS, 'svg');
    svgElement.setAttribute('width', '100');
    svgElement.setAttribute('height', '100');

    const circle = document.createElementNS(svgNS, 'circle');
    circle.setAttribute('cx', '50');
    circle.setAttribute('cy', '50');
    circle.setAttribute('r', '40');
    circle.setAttribute('stroke', 'black');
    circle.setAttribute('stroke-width', '3');
    circle.setAttribute('fill', 'red');

    svgElement.appendChild(circle);
    svgContainer.appendChild(svgElement);
}

// Yazdırma fonksiyonu
function printSVG() {
    const printWindow = window.open('', '_blank');
    const svgContainer = document.getElementById('svg-container').innerHTML;

    printWindow.document.write(`
        <html>
        <head>
            <title>Print</title>
        </head>
        <body>
            ${svgContainer}
            <script>
                window.onload = function() {
                    window.print();
                    window.onafterprint = function() {
                        window.close();
                    }
                }
            </script>
        </body>
        </html>
    `);
}

// SVG oluştur ve yazdır
createSVG();
printSVG();
