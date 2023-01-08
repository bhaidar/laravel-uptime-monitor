<?php

namespace Database\Seeders;

use App\Models\Endpoint;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EndpointSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run($site_id)
    {
        Endpoint::factory(1)->create([
            'site_id' => $site_id,
        ]);
    }
}
