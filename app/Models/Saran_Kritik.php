<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Saran_Kritik extends Model
{
    // use HasFactory;

    protected $table = "saran_kritik";

    protected $fillable = [
        "nama",
        "saran_kritik"
    ];

    public function User()
    {
        return $this->belongsTo(User::class);
    }
}
