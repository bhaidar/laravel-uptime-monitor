<?php

namespace App\Observers;

use App\Events\EndpointWentDown;
use App\Models\Check;

class CheckObserver
{
    public function created(Check $check)
    {
        // if check wasn't successful
        // was the previous check successful, or was this the first check?
        // hen send endpoint down notification

        if (!$check->isSuccessful()
            &&
            ($check->previous()?->isSuccessful() || $check->endpoint->checks->count() === 1)
        )
        {
            EndpointWentDown::dispatch($check);
        }
    }
}
