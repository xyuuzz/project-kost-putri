<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\PaymentResult;
use Illuminate\Support\Facades\{Auth, Date};

class Order
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
        // Jika user memiliki payment result maka masuk
        if ( count(Auth::user()->payment_results) )
        {
            // Mengecek status belanja terakhir milik user
            $payment = \Midtrans\Transaction::status(PaymentResult::where("user_id", Auth::id())->latest()->first()->order_id);

            // Ketika nilai dari payment false(gagal menemukan status dengan order id yang diberikan)
            if (!$payment) {
                // Hapus baris dengan order id tersebut
                PaymentResult::where("user_id", Auth::id())->latest()->first()->delete();

                // Jika halaman yang dituju adalah list transaksi maka, return ke halaman tersebut
                if( request()->is("daftar-transaksi") ) {
                    return $next($request);
                }

                // Redirect ke halaman Home
                return redirect(route("home"));
            }

        // -------------------------- //

            $result_payment = Auth::user()->payment_results->toQuery()
            ->whereMonth("created_at", Date::now()->format("m"))
            ->latest()->first();

            $order = $result_payment->created_at;
            $month_now = Date::now()->format("m");
            $last_transaction_month = $order->format("m");

            // Jika bulan transaksi terakhir sama dengan bulan ini, maka return halaman dan kirimkan $order,, namun jika tidak artinya adalah bulan sudah berganti,, maka kita goto ke bawah agar berpindah.
            if ($month_now === $last_transaction_month)
            {
                // Jika transaksi status adalah berhasil(settlement), maka redirect ke daftar transaksi dan kirim pesan sudah membayar, Namun jika transaksi status nya adalah pending(belum dibayar), maka redirect ke daftar transaksi dan kirim pesan pembayaran harus diselesaikan terlebih dahulu
                if( $payment->transaction_status === "settlement" ) {
                    return redirect(route("daftar_transaksi"))->with("warning", "Anda Sudah membayar Bulan ini");
                } elseif ($payment->transaction_status === "pending") {
                    return redirect(route("daftar_transaksi"))->with("warning", "Selesaikan Transaksi Anda Pada Bulan " . Date::now()->format("F") . " Terlebih Dahulu");
                }
            }
        }

        // lanjut ke halaman yang dituju
        return $next($request);
    }
}
