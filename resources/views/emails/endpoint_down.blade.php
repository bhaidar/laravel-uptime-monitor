<x-mail::message>
    # {{ $endpoint->location }} went down

    It looks like {{ $endpoint->url() }} is down. We'll email and let you know when it's recovered.

    <x-mail::button :url="route('dashboard', $endpoint->site)">
        Visit dashboard
    </x-mail::button>

    Thanks,<br>
    {{ config('app.name') }}
</x-mail::message>
