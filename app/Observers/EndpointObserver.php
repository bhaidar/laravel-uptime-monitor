<?php

namespace App\Observers;

use App\Models\Endpoint;
use Illuminate\Support\Arr;

class EndpointObserver
{
    public function creating(Endpoint $endpoint): void
    {
        $parsed = parse_url($endpoint->site->url() . '/' . $endpoint->location);

        // normalize endpoint location by removing any additional '/' or '?'
        $endpoint->location = '/' . trim(trim(Arr::get($parsed, 'path'), '/') . '?' . Arr::get($parsed, 'query'), '?');

        $endpoint->next_check = now()->addSeconds($endpoint->frequency);
    }
}
