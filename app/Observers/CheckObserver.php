<?php

namespace App\Observers;

use App\Events\EndpointRecovered;
use App\Events\EndpointWentDown;
use App\Models\Check;

class CheckObserver
{
    public function created(Check $check)
    {
        // Went Down
        // if check wasn't successful
        // was the previous check successful, or was this the first check?
        // then send endpoint down notification

        if (!$check->isSuccessful()
            &&
            ($check->previous()?->isSuccessful() || $check->endpoint->checks->count() === 1)
        )
        {
            EndpointWentDown::dispatch($check);
        }

        // Went up
        // if check is successful
        // was the previous check unsuccessful
        // and
        // the checks are different from 1 (meaning don't send recovery for first time adding endpoint)
        // then send endpoint up notification

        if ($check->isSuccessful()
            &&
            (!$check->previous()?->isSuccessful() && $check->endpoint->checks->count() !== 1)
        )
        {
            EndpointRecovered::dispatch($check);
        }
    }
}
