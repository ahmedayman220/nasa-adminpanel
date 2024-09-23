var resultContainer = document.getElementById("qr-reader-results");
var lastResult,
    countResults = 0;

function onScanSuccess(decodedText, decodedResult) {
    if (decodedText !== lastResult) {
        ++countResults;
        lastResult = decodedText;
        // Handle on success condition with the decoded message.
        console.log(`Scan result ${decodedText}`, decodedResult);
        document.location = '/admin/workshop-assignment/scan/' + decodedText;
    }
}
var html5QrcodeScanner = new Html5QrcodeScanner("qr-reader", {
    fps: 10,
    qrbox: 250,
});
html5QrcodeScanner.render(onScanSuccess);

// Hide and Display the scanner functionality
const scanBtn = document.querySelector(".scan-Qrcode");
const closeScannerBtn = document.querySelector(".close-scanning");
const qrContainer = document.querySelector(".qrcode-container");

function displayQrScanner() {
    qrContainer.classList.remove("hide-scanner");
}
function hideQrScanner() {
    qrContainer.classList.add("hide-scanner");
}

scanBtn.addEventListener("click", displayQrScanner);
closeScannerBtn.addEventListener("click", hideQrScanner);
