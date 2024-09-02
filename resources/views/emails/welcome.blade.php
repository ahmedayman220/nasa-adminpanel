<x-mail::message>
# Welcome {{$name}}

Here is your Qr Code
    <br>
    <img src="{{public_path('QR/'.$national.'.png')}}" alt="QR Failed">
    <br>
    Your national ID is <strong>{{$national}}</strong>
    <br>
    Your workshop is <strong>{{$workshop}}</strong> and please attend by <strong>{{$time}}</strong>
<x-mail::button :url="''">
Button Text
</x-mail::button>

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
