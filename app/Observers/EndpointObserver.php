<?php

namespace App\Observers;

use App\Models\Endpoint;

class EndpointObserver
{
    public function creating(Endpoint $endpoint)
    {
        $endpoint->next_check = now()->addSeconds($endpoint->frequency);
    }
}
