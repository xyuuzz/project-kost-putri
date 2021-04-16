<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    // use HasFactory;

    protected $fillable = [
        "name",
        "nomor_hp",
        "foto_profil",
        "universitas",
        "kamar_id",
    ];

    // Relasi dengan table User
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    public function kamar_kost()
    {
        return $this->belongsTo(KamarKost::class,"kamar_id", "no_kamar");
    }
}
