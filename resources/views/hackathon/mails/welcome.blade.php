<x-mail::message>
# Introduction

Greetings <strong>{{$name}}</strong> <br>
    Your Ticket ID is <strong>{{$uuid}}</strong><br>
    @if($qr_path)
        <img src="{{$qr_path}}" alt="imagine a qrcode here">
    @endif
<x-mail::button :url="''">
Button Text
</x-mail::button>

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
