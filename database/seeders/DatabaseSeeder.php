<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $user = User::factory()->create([
            'email' => 'bhaidar@gmail.com',
            'password' => Hash::make('secret'),
            'name' => 'Bilal Haidar',
        ]);

        $this->callWith(SiteSeeder::class, ['user_id' => $user->id]);
    }
}
