<x-mail::message>
# Introduction

Greetings, {{$member->name}}<br>
 Team name: {{$team->team_name}} <br>
<x-mail::button :url="''">
Button Text
</x-mail::button>

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
