<?php

namespace Database\Seeders;

use App\Models\Profile;
use Illuminate\Database\Seeder;

class ProfileSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $profiles = [ 
            [
            "name" => "Maulana Yusuf",
            "user_id" => 1,
            "nomor_hp" => "087731941581",
            "foto_profil" => "avatar.png",
            "universitas" => "Universitas Diponegoro"
        ], [
            "name" => "Mbak Kost ",
            "user_id" => 2,
            "nomor_hp" => "081325733399",
            "foto_profil" => "avatar.png",
            "universitas" => "STIE BPD Jateng"
            ]
        ];

        foreach($profiles as $key => $value) {
            Profile::create($value);
        }
    }
}
