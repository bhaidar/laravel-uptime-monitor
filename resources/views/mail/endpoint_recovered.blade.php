<x-mail::message>
# {{ $endpoint->location }} recovered

Great news! {{ $endpoint->url() }} has recovered.

<x-mail::button :url="route('dashboard', $endpoint->site)">
    Visit dashboard
</x-mail::button>

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
