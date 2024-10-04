@extends('layouts.admin')
@section('styles')
    <link rel="stylesheet" href="{{asset('css/scannerNew.css')}}"/>
@endsection

@section('content')
    @if(session()->has('success'))
        <div class="alert alert-success" role="alert">
            {{session()->get('success')}}
        </div>

    @endif
    @if(session()->has('failed'))
        <div class="alert alert-danger" role="alert">
            {{session()->get('failed')}}
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
                <button class="btn  scan-Qrcode" data-toggle="modal">
                    <img src="{{ asset('images/scan-me-free-png.png') }}" alt="">
                </button>
            </div>
        </div>
    </div>
    {{--Qr Scanner --}}
    <div class="container mx-auto qrcode-container hide-scanner">
        <p class="close-scanning">x</p>
        <div id="qr-reader">

        </div>
        <div id="qr-reader-results"></div>
    </div>
    <div class="overlay hide-scanner"></div>
    {{--                      document.location = "/admin/checkpoints/scan/" + decodedText +"{{'/'.$checkpoint_id . '/' . $checkpoint_name}}";
          --}}
    {{--End Qr Scanner --}}
@endsection
@section('scripts')
    <script src="https://unpkg.com/html5-qrcode"></script>
    <script>
        var resultContainer = document.getElementById("qr-reader-results");
        var lastResult,
            countResults = 0;

        function onScanSuccess(decodedText, decodedResult) {
            if (decodedText !== lastResult) {
                ++countResults;
                lastResult = decodedText;
                // Handle on success condition with the decoded message.
                console.log(`Scan result ${decodedText}`, decodedResult);
                document.location = "/admin/checkpoints/scan/" + decodedText + "{{'/'.$checkpoint_id . '/' . $checkpoint_name}}";
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
        const overlay = document.querySelector(".overlay");

        function displayQrScanner() {
            qrContainer.classList.remove("hide-scanner");
        }

        function hideQrScanner() {
            qrContainer.classList.add("hide-scanner");
        }

        function displayOverlay() {
            overlay.classList.remove("hide-scanner");
        }

        function hideOverlay() {

            overlay.classList.add("hide-scanner");
        }

        scanBtn.addEventListener("click", function () {
            displayQrScanner();
            displayOverlay();
        });
        closeScannerBtn.addEventListener("click", function () {
            hideQrScanner();
            hideOverlay();
        });

        scanBtn.addEventListener("click", displayQrScanner);
        closeScannerBtn.addEventListener("click", hideQrScanner);


    </script>
@endsection
