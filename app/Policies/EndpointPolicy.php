<?php

namespace App\Policies;

use App\Models\Endpoint;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class EndpointPolicy
{
    use HandlesAuthorization;

    public function destroy(User $user, Endpoint $endpoint): bool
    {
        return $user->id === $endpoint->site->user_id;
    }

    public function show(User $user, Endpoint $endpoint): bool
    {
        return $user->id === $endpoint->site->user_id;
    }

    public function update(User $user, Endpoint $endpoint): bool
    {
        return $user->id === $endpoint->site->user_id;
    }
}
