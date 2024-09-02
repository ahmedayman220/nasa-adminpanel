<x-mail::message>
# Welcome {{$name}}

Here is your Qr Code
    <br>
    <img src="{{ $path }}" alt="QR Failed">
    <br>
    Your national ID is <strong>{{$national}}</strong>
    <br>
    @if($workshop && $time)
    Your workshop is <strong>{{$workshop}}</strong> and please attend by <strong>{{$time}}</strong>.
    @else
        Sadly,you are not eligible to attend workshop, but good news! you are still welcome to attend the bootcamp!
    @endif
    <strong>
        <br>Thanks,<br>
        {{ config('app.name') }}
    </strong>
</x-mail::message>
