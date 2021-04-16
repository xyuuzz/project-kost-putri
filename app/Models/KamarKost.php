<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KamarKost extends Model
{
    // use HasFactory;
    public $table = "kamar_kost";
    public $fillable = ["no_kamar", "harga"];

    public function profile()
    {
        return $this->hasOne(Profile::class, "kamar_id", "no_kamar");
    }
}
