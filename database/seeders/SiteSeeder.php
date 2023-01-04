<?php

namespace Database\Seeders;

use App\Models\Site;
use App\Models\User;
use Database\Seeders\Userer as UsererAlias;
use Illuminate\Database\Seeder;

class SiteSeeder extends Seeder
{
    public function run($user_id): void
    {
        Site::factory()->count(2)->create([
            'user_id' => $user_id,
        ]);
    }
}
