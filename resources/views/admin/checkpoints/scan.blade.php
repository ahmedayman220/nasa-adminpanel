@extends('layouts.admin')
@section('styles')
    <link rel="stylesheet" href="{{asset('css/scannerNew.css')}}"/>
@endsection

@section('content')
    @if(session()->has('success'))
        <div class="alert alert-success" role="alert">
            {{session()->get('success')}}
            @if(session()->has('size'))
                <span class="badge badge-info" style="font-size: 20px;">{{ session()->get('size') }}</span>
            @endif
        </div>
    @endif
    @if(session()->has('failed'))
        <div class="alert alert-danger" role="alert">
            {{session()->get('failed')}}
            @if(session()->has('size'))
                <span class="badge badge-info" style="font-size: 20px;">{{ session()->get('size') }}</span>
            @endif
        </div>
    @endif
    <div class="card">
        <div class="card-header">
            Scan {{$checkpoint_name}} Page
            @if(session()->has('size'))
                <span class="badge badge-info" style="font-size: 20px;">{{ session()->get('size') }}</span>
            @endif
        </div>
        <div class="card-body">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.checkpoints.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
                <button class="btn scan-Qrcode" data-toggle="modal">
                    <img src="{{ asset('images/scan-me-free-png.png') }}" alt="">
                </button>
            </div>
        </div>
    </div>
    {{--Qr Scanner --}}
    <div class="container mx-auto qrcode-container hide-scanner">
        <p class="close-scanning">x</p>
        <div id="qr-reader"></div>
        <div id="qr-reader-results"></div>
    </div>
    <div class="overlay hide-scanner"></div>
    {{--End Qr Scanner --}}
@endsection

@section('scripts')
    <script src="https://unpkg.com/html5-qrcode"></script>
    <script>
        var resultContainer = document.getElementById("qr-reader-results");
        var lastResult, countResults = 0;
        var html5QrcodeScanner; // Declare the QR code scanner variable

        function onScanSuccess(decodedText, decodedResult) {
            if (decodedText !== lastResult) {
                ++countResults;
                lastResult = decodedText;
                // Handle on success condition with the decoded message.
                console.log(`Scan result ${decodedText}`, decodedResult);
                document.location = "/admin/checkpoints/scan/" + decodedText + "{{'/'.$checkpoint_id . '/' . $checkpoint_name}}";
            }
        }

        // Check and request camera permission only once
        function checkCameraPermissionAndScan() {
            // Check if permission was already granted in a previous session
            if (sessionStorage.getItem('cameraPermissionGranted') === 'true') {
                // If permission is already granted, display QR code scanner directly
                displayQrScanner();
            } else {
                // Otherwise, check current permission status
                navigator.permissions.query({ name: 'camera' }).then(function (permissionStatus) {
                    if (permissionStatus.state === 'granted') {
                        // Permission is already granted, proceed with QR code scanning
                        sessionStorage.setItem('cameraPermissionGranted', 'true'); // Store permission in session
                        displayQrScanner();
                    } else if (permissionStatus.state === 'prompt') {
                        // Permission hasn't been granted yet, request it
                        navigator.mediaDevices.getUserMedia({ video: true })
                            .then(function (stream) {
                                // Permission granted, store the permission and proceed with QR code scanning
                                sessionStorage.setItem('cameraPermissionGranted', 'true'); // Store permission in session
                                displayQrScanner();
                            })
                            .catch(function (err) {
                                console.log("Camera permission denied", err);
                            });
                    } else if (permissionStatus.state === 'denied') {
                        alert("Camera access has been denied. Please enable it from browser settings.");
                    }
                });
            }
        }

        // Hide and Display the scanner functionality
        const scanBtn = document.querySelector(".scan-Qrcode");
        const closeScannerBtn = document.querySelector(".close-scanning");
        const qrContainer = document.querySelector(".qrcode-container");
        const overlay = document.querySelector(".overlay");

        function displayQrScanner() {
            qrContainer.classList.remove("hide-scanner");
            overlay.classList.remove("hide-scanner");

            // Initialize QR scanner once permission is granted and it hasn't been initialized yet
            if (!html5QrcodeScanner) {
                html5QrcodeScanner = new Html5QrcodeScanner("qr-reader", {
                    fps: 10,
                    qrbox: 250,
                });
                html5QrcodeScanner.render(onScanSuccess);
            }
        }

        function hideQrScanner() {
            qrContainer.classList.add("hide-scanner");
            overlay.classList.add("hide-scanner");
        }

        // Check camera permission and scan when the scan button is clicked
        scanBtn.addEventListener("click", function () {
            checkCameraPermissionAndScan();
        });

        closeScannerBtn.addEventListener("click", function () {
            hideQrScanner();
        });
    </script>
@endsection
