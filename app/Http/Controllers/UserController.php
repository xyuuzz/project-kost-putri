<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{KamarKost, Saran_Kritik};
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function store_saran_kritik(Request $request)
    {
        $request->validate([
            "nama" => "string|required|max:40|min:4",
            "saran_kritik" => "string|required"
        ]);

        // Buat Data Kritik dan Saran
        Saran_Kritik::create([
            "nama" => $request->nama,
            "saran_kritik" => $request->saran_kritik
        ]);

        return redirect(route("home"))->with("success", "Saran dan Kritik Berhasil Dikirimkan, Terimakasih Atas Masukanya");
    }

    public function price_page() {
        $data = KamarKost::get();

        return view("view.harga_kamar_kost", compact("data"));
    }
}
