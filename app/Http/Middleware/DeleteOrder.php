<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\PaymentResult;
use Illuminate\Support\Facades\Auth;


class DeleteOrder
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        // cek apakah user memiliki riwayat transaksi
        if (count(Auth::user()->payment_results))
        {
            // Mengecek status belanja terakhir milik user
            $payment = \Midtrans\Transaction::status(PaymentResult::where("user_id", Auth::id())->latest()->first()->order_id);
            // Ketika nilai dari payment false(gagal menemukan status dengan order id yang diberikan)

            // jika payment bernilai false, maka order_id tersebut tidak ada di dalam midtrans, sehingga kita hapus
            if (!$payment)
            {
                // Hapus baris riwayat transaksi terakhir.
                PaymentResult::where("user_id", Auth::id())->latest()->first()->delete();
            }
        }

        // ke halaman yang dituju
        return $next($request);
    }
}
