<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use App\Models\KamarKost;
use Illuminate\Http\Request;
use App\Models\PaymentResult;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Date;
use function PHPUnit\Framework\isJson;

class PaymentController extends Controller
{

    public function cicilan()
    {
        session()->flash("cicilan", "cicilan");
        return view("payments.cicilan");
    }

    public function bulanan()
    {
        session()->flash("bulanan", "bulanan");
        return redirect(route("bayar"));
    }

    public function mount(Request $request)
    {
        // berisi array session yang berisi info apakah user membayar bulanan atau cicilan
        $type_pembayaran = session()->get("cicilan") ?? session()->get("bulanan");
        // Jika tidak ada session yang berisi cicilan atau bulanan, maka redirect ke halaman home
        if( !$type_pembayaran ) {
            return redirect(route("home"));
        }

        // ------------------------------------------- //

        // Deskripsi Belanjaan
        $order_id = rand();
        $harga = $request["jumlah"] ?? Auth::user()->profile->kamar_kost()->first()->harga;
        $params = array(
            'transaction_details' => array(
                'order_id' => $order_id,
                'gross_amount' => $harga
            ),
            'customer_details' => array(
                'first_name' => 'Mbak ',
                'last_name' => Auth::user()->profile->name,
                'email' => Auth::user()->email,
                'phone' => Auth::user()->profile->nomor_hp,
            ),
        );

        // Buat Token dengan parameter info barang
        $snapToken = \Midtrans\Snap::getSnapToken($params);

        // Masukan result order_id dan type ke dalam table payment_result
        Auth::user()->payment_results()->create([
            "order_id" => $order_id,
            "type" => $type_pembayaran,
            "snap_token" => $snapToken,
        ]);

        return view("payments.payment", compact("snapToken", "harga"));
    }

    public function list_transaction(PaymentResult $payments, Request $request, Profile $profile)
    {
        // Jika role user adalah admin
        if (Auth::user()->role === "admin")
        {
            if (request("query")) {
                $profile_query = $profile->where("name", "like", "%{$request["query"]}%")->first("user_id");

                if ($profile_query) { // true => jika hasil query terdapat pada field name on table profile
                    $payments = $payments->where("user_id", $profile_query->user_id)->latest()->paginate(3);
                } else {
                    $payments = $payments->latest()->paginate(3);
                    session()->flash("error", "Tidak ada data yang bernama " + request("query"));
                }
            } else {
                $payments = $payments->latest()->paginate(3);
            }
        }
        // Jika role user adalah mbak kost/user
        else {
            $payments = $payments->where("user_id", Auth::id())->latest()->paginate(3);
        }
        return view("payments.list_transaction", compact("payments"));
    }

    public function detail_transaction($order_id)
    {
        // mendapatkan baris order_id
        $order = PaymentResult::where("order_id", $order_id)->first();

        // Mendapatkan status pembayaran
        $payment = \Midtrans\Transaction::status($order->order_id);
        return view("payments.detail_transaction", compact("order", "payment"));
    }


}
