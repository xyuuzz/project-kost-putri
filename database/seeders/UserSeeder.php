<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Mengisi field table dengan role admin
        $user = [ 
            [
            "username" => "mauyu",
            "slug" => "mauyu-" . uniqid(),
            "role" => "admin",
            "email" => "maulanayuusuf023@gmail.com",
            "password" => bcrypt("password"),
            ], [
                "username" => "kostku",
                "slug" => "kostku-" . uniqid(),
                "role" => "user",
                "email" => "kostkumantab@gmail.com",
                "password" => bcrypt("password123"),
            ]
        ];

        foreach($user as $key => $value) {
            User::create($value);
        }

        // Cara memasukan data ke dalam database menggunakan seeder :
        // php artisan db:seed --class="namaClass"
    }
}
