<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Database\Seeders\{UserSeeder, ProfileSeeder, KamarKostSeeder};

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UserSeeder::class);
        $this->call(ProfileSeeder::class);
        $this->call(KamarKostSeeder::class);
    }
}
