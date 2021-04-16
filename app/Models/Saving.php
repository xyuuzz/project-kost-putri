<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Saving extends Model
{
    protected $table = "savings", $fillable = ["pemasukan", "pengeluaran", "deskripsi", "tanggal"];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
