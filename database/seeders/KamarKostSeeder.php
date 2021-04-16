<?php

namespace Database\Seeders;

use App\Models\KamarKost;
use Illuminate\Database\Seeder;

class KamarKostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = [ 
            [
            "no_kamar" => 1,
            "harga" => 650000
            ], 
            [
                "no_kamar" => 2,
                "harga" => 650000
            ],
            [
                "no_kamar" => 3,
                "harga" => 650000
            ],
            [
                "no_kamar" => 4,
                "harga" => 850000
            ],
            [
                "no_kamar" => 5,
                "harga" => 750000
            ],
            [
                "no_kamar" => 6,
                "harga" => 650000
            ],
            [
                "no_kamar" => 7,
                "harga" => 650000
            ],
            [
                "no_kamar" => 8,
                "harga" => 800000
            ],
        ];

        foreach($user as $key => $value) {
            KamarKost::create($value);
        }
    }
}
