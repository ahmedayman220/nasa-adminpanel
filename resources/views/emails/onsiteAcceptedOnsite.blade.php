<x-mail::message>
# Introduction
    Greetings,{{$currentMember->name}}
    <br>
your team is {{$team->team_name}} <br>
    @foreach($members as $member)
        {{$member->name }}<br>
    @endforeach
    <br>
    <img src="{{$qrCode}}" alt="beeb">
<x-mail::button :url="''">
Button Text
</x-mail::button>

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
