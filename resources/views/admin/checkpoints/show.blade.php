@extends('layouts.admin')
{{--@section('styles')--}}
{{--    <link rel="stylesheet" href="{{asset('css/scanner.css')}}"/>--}}
{{--@endsection--}}

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
    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.checkpoints.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
                <a href="{{route('admin.checkpoints.showScan',[$checkpoint->id,$checkpoint->name])}}" class="btn btn-warning scan-Qrcode">
                    Scan Qr Code
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.checkpoint.fields.id') }}
                        </th>
                        <td>
                            {{ $checkpoint->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.checkpoint.fields.event') }}
                        </th>
                        <td>
                            {{ $checkpoint->event->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.checkpoint.fields.checkpoint_type') }}
                        </th>
                        <td>
                            {{ $checkpoint->checkpoint_type->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.checkpoint.fields.name') }}
                        </th>
                        <td>
                            {{ $checkpoint->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.checkpoint.fields.description') }}
                        </th>
                        <td>
                            {!! $checkpoint->description !!}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.checkpoints.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
    <hr>
    <div class="d-flex">
        {{-- Start Manual Div --}}
        <div class="card-body">
            <form method="POST" action="{{ route("admin.checkpoints.manualScan") }}">
                @csrf
                <div class="form-group">
                    <input type="hidden" name="checkpoint_id" value="{{$checkpoint->id}}">
                    <input type="hidden" name="checkpoint_name" value="{{$checkpoint->name}}">
                    <label class="required"
                           for="member_uuid">{{"Update Member Status With UUID" }}</label>
                    <select
                        class="form-control select2"
                        name="member_uuid" id="member_uuid" required>
                        @foreach($members as $member)
                            <option
                                value="{{ $member->uuid }}">{{ $member->uuid." : ".$member->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <button class="btn btn-danger" type="submit">
                        {{ trans('global.save') }}
                    </button>
                </div>
            </form>
        </div>
        {{-- End Manual Div --}}

        {{-- Start National Div --}}
        <div class="card-body">
            <form method="POST" action="{{ route("admin.checkpoints.manualScan") }}">
                @csrf
                <div class="form-group">
                    <input type="hidden" name="checkpoint_id" value="{{$checkpoint->id}}">
                    <input type="hidden" name="checkpoint_name" value="{{$checkpoint->name}}">
                    <label class="required"
                           for="member_uuid">{{"Update Member Status With National" }}</label>
                    <select
                        class="form-control select2 "
                        name="member_uuid" id="member_uuid" required>
                        @foreach($members as $member)
                            <option
                                value="{{ $member->uuid }}">{{ $member->national}}
                                : {{ $member->email}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <button class="btn btn-danger" type="submit">
                        {{ trans('global.save') }}
                    </button>
                </div>
            </form>
        </div>

        {{-- End National Div --}}
    </div>
</div>

<div class="card">
    <div class="card-header">
        {{ trans('global.relatedData') }}
    </div>
    <ul class="nav nav-tabs" role="tablist" id="relationship-tabs">
        <li class="nav-item">
            <a class="nav-link" href="#checkpoint_member_checkpoints" role="tab" data-toggle="tab">
                {{ trans('cruds.memberCheckpoint.title') }}
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane" role="tabpanel" id="checkpoint_member_checkpoints">
            @includeIf('admin.checkpoints.relationships.checkpointMemberCheckpoints', ['memberCheckpoints' => $checkpoint->checkpointMemberCheckpoints])
        </div>
    </div>
</div>

{{--    --}}{{--Qr Scanner --}}
{{--    <div class="container mx-auto qrcode-container hide-scanner">--}}
{{--        <p class="close-scanning">x</p>--}}
{{--        <div id="qr-reader">--}}

{{--        </div>--}}
{{--        <div id="qr-reader-results"></div>--}}
{{--    </div>--}}
{{--    <div class="overlay hide-scanner"></div>--}}

{{--    --}}{{--End Qr Scanner --}}
@endsection
{{--@section('scripts')--}}
{{--    <script src="https://unpkg.com/html5-qrcode"></script>--}}
{{--    <script>--}}
{{--        var resultContainer = document.getElementById("qr-reader-results");--}}
{{--        var lastResult,--}}
{{--            countResults = 0;--}}

{{--        function onScanSuccess(decodedText, decodedResult) {--}}
{{--            if (decodedText !== lastResult) {--}}
{{--                ++countResults;--}}
{{--                lastResult = decodedText;--}}
{{--                // Handle on success condition with the decoded message.--}}
{{--                console.log(`Scan result ${decodedText}`, decodedResult);--}}
{{--                document.location = "/admin/checkpoints/scan/" + decodedText +"{{'/'.$checkpoint->id . '/' . $checkpoint->name}}";--}}
{{--            }--}}
{{--        }--}}
{{--        var html5QrcodeScanner = new Html5QrcodeScanner("qr-reader", {--}}
{{--            fps: 10,--}}
{{--            qrbox: 250,--}}
{{--        });--}}
{{--        html5QrcodeScanner.render(onScanSuccess);--}}

{{--        // Hide and Display the scanner functionality--}}
{{--        const scanBtn = document.querySelector(".scan-Qrcode");--}}
{{--        const closeScannerBtn = document.querySelector(".close-scanning");--}}
{{--        const qrContainer = document.querySelector(".qrcode-container");--}}

{{--        function displayQrScanner() {--}}
{{--            qrContainer.classList.remove("hide-scanner");--}}
{{--        }--}}
{{--        function hideQrScanner() {--}}
{{--            qrContainer.classList.add("hide-scanner");--}}
{{--        }--}}

{{--        scanBtn.addEventListener("click", displayQrScanner);--}}
{{--        closeScannerBtn.addEventListener("click", hideQrScanner);--}}

{{--    </script>--}}
{{--@endsection--}}
