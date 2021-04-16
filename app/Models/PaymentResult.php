<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PaymentResult extends Model
{
    public $table = "payment_results";
    // use HasFactory;
    public $fillable = ["order_id", "type", "snap_token"];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
