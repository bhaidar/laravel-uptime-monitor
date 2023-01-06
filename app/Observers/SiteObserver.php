<?php

namespace App\Observers;

use App\Models\Site;

class SiteObserver
{
    public function updating(Site $site)
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
