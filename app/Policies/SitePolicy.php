<?php

namespace App\Policies;

use App\Models\Site;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class SitePolicy
{
    use HandlesAuthorization;

    public function destroySite(User $user, Site $site): bool
    {
        return $user->id === $site->user_id;
    }

    public function destroyNotificationChannels(User $user, Site $site): bool
    {
        return $user->id === $site->user_id;
    }

    public function storeNotificationChannels(User $user, Site $site): bool
    {
        return $user->id === $site->user_id;
    }

    public function storeEndpoint(User $user, Site $site): bool
    {
        return $user->id === $site->user_id;
    }
}
