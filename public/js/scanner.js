var resultContainer = document.getElementById("qr-reader-results");
console.log(resultContainer);
var lastResult,
    countResults = 0;

function onScanSuccess(decodedText, decodedResult) {
    if (decodedText !== lastResult) {
        ++countResults;
        lastResult = decodedText;
        // Handle on success condition with the decoded message.
        console.log(`Scan result ${decodedText}, decodedResult`);
        document.location = "/admin/bootcamp-attendees/scan/" + decodedText;
    }
}

function getQrboxSize() {
    const width = window.innerWidth;

    if (width <= 370) {
        // For mobile devices
        return 150;
    } else if (width <= 768) {
        // For tablets
        return 200;
    } else {
        // For desktops
        return 250;
    }
}

var html5QrcodeScanner = new Html5QrcodeScanner("qr-reader", {
    fps: 10,
    qrbox: getQrboxSize(),
});

// Update qrbox size when the window is resized
window.addEventListener("resize", function () {
    html5QrcodeScanner.clear(); // Clear the scanner
    html5QrcodeScanner = new Html5QrcodeScanner("qr-reader", {
        fps: 10,
        qrbox: getQrboxSize(),
    });
});

// Function to start the QR code scanner
function startQrScanner() {
    html5QrcodeScanner.render(onScanSuccess);
}

// Hide and Display the scanner functionality
const scanBtn = document.querySelector(".scan-Qrcode");
const closeScannerBtn = document.querySelector(".close-scanning");
const qrContainer = document.querySelector(".qrcode-container");
const overlay = document.querySelector(".overlay");

function displayQrScanner() {
    qrContainer.classList.remove("hide-scanner");
    overlay.classList.remove("hide-scanner");

    // Restart the scanner when displaying it again
    startQrScanner();
}

function hideQrScanner() {
    qrContainer.classList.add("hide-scanner");
    overlay.classList.add("hide-scanner");

    // Stop the scanner and clear the resources
    html5QrcodeScanner
        .clear()
        .then(() => {
            console.log("QR code scanning stopped.");
        })
        .catch((err) => {
            console.error(`Error stopping the scanner: ${err}`);
        });
}

// Event listeners for buttons
scanBtn.addEventListener("click", displayQrScanner);
overlay.addEventListener("click", hideQrScanner); // Hide scanner and stop camera on overlay click

// Stop the scanner and hide the overlay when the close button is clicked
closeScannerBtn.addEventListener("click", hideQrScanner);
