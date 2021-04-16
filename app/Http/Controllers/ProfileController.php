<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Profile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function __construct()
    {
        $this->table = new Profile();
    }

    public function index(User $user)
    {
        return view("view.profile.index", compact("user"));
    }


    public function update(Profile $profile, Request $request) 
    {
        // Memvalidasi Data
        $request->validate([
            "username" => "string|alpha_dash|min:4|max:12",
            "email" => "email",
            "nomor_hp" => "numeric|digits:12",
            "universitas" => "string",
            "foto_profile" => "image|mimes:png,jpg,jpeg,jfif"
        ]);

        
        // Ambil data untuk update data table profile
        $data_profile = $request->only("email", "nomor_hp", "universitas");

        // Logic Gambar
        if ($request->file("foto_profile")) 
        {
            // Jika foto nya bukan avatar, maka hapus . Jika avatar tidak dihapus
            if ($request->file("foto_profile") !== "avatar.png") {

                if( Auth::user()->profile->foto_profil !== "avatar.png") {
                    Storage::delete("public/images/profile/{$profile->foto_profil}");
                }

            }

            $foto = $request->file("foto_profile");
            $file_foto = uniqid() . ".{$foto->extension()}";
            // Pindahkan foto ke file storage
            $foto->storeAs("public/images/profile", $file_foto);
            // Tambahkan element array ada $data_profile yang berisi file foto
            $data_profile["foto_profil"] = $file_foto;
        }   

        // Update Data pada Table Profile
        $profile->update($data_profile);

        // Update Data pada Table Users
        $profile->user->update([
            "username" => $request->username
        ]);
        
        if( Auth::id() === 1) {
            return redirect(route("home_admin"))->with("success", "Data Profile Berhasil Diubah");
        }

        return redirect(route("home"))->with("success", "Data Profile Berhasil Diubah");
    }
}
