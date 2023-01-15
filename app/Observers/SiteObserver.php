<?php

namespace App\Observers;

use App\Models\Site;
use Illuminate\Support\Arr;

class SiteObserver
{
    public function creating(Site $site): void
    {
        $parsed = parse_url($site->domain);

        $site->scheme = Arr::get($parsed, 'scheme');
        $site->domain = Arr::get($parsed, 'host');
    }

    public function updating(Site $site): void
    {
        // getDirty(): Get the attributes that have been changed since the last sync.

        // If the 'default' column is being updated
        // DashboardController sets the Site to default true
        if (in_array('default', array_keys($site->getDirty())))
        {
            // Make the rest of sites for this user all have default false
            $site->user->sites()->whereNot('id', $site->id)->update(['default' => false]);
        }
    }
}
