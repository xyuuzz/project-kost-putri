<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\AccountRequest;
use App\Http\Requests\EditAccountRequest;
use Illuminate\Support\Facades\Storage;
use App\Models\{KamarKost, PaymentResult, Profile, Saran_Kritik, User};


class AdminController extends Controller
{
    public function home_admin(Request $request)
    {
        // Ambil user yang role nya "user"
        $users_ = User::where("role", "user");

        if( $query = request("query") ) {   // Jika request query dari tombol search ada, maka jalankan code dibawah
            $users = $users_->where("username", "like", "%{$request["query"]}%");
        } 

        $users = $users_->latest()->paginate(3);
        return view("view.admin.admin", compact("users"));
    }

    public function create_account(KamarKost $kamar) 
    {
        $list_kamar = $kamar->all();
        $profile = Profile::where("id", "!=", 1)->get();
        return view("view.admin.create_mbak_kost", compact("list_kamar", "profile"));
    }

    public function store_account(AccountRequest $request)
    {
        // Buat Data User
        $data_users = $request->only("username", "email", "password");
        $data_users["slug"] = $data_users["username"] . "-" . uniqid();
        $data_users["role"] = "user";
        $data_users["password"] = bcrypt( $data_users["password"] );
        User::create($data_users);

        $user = User::where("email", "{$data_users['email']}")->first();

        // Buat Data Profile
        $data_profile = $request->except("username", "email", "password");
        $data_profile["foto_profil"] = "avatar.png";
        $user->profile()->create($data_profile);

        return redirect(route("home_admin"))->with("success", "User Berhail Ditambahkan");
    }

    public function delete_account(User $user) 
    {
        // Hapus foto Profile
        if( $user->profile->foto_profil !== "avatar.png") {
            Storage::delete("public/images/profile/{$user->profile->foto_profil}");
        }
        
        // Delete table profile
        $user->profile->delete();
        $user->savings()->delete();
        $user->saran_kritik()->delete();
        $user->payment_results()->delete();
        
        // Delete table User
        $user->delete();

        return redirect(route("home_admin"))->with("success", "Data User Berhasil Dihapus");
    }

    
    // function masukan kritik dan saran
    public function list_kritik_saran()
    {
        $list = Saran_Kritik::latest()->paginate(3);
        return view("view.admin.list_saran_kritik", compact("list"));
    }


    public function delete_saran_kritik($id)
    {
        $table = Saran_Kritik::where("id", $id)->first();
        
        $table->delete();

        return redirect(route("list_kritik_saran"))->with("success", "Data Saran dan Kritik Berhasil dihapus");
    }


    public function edit_account(User $user)
    {
        return view("view.admin.edit_mbak_kost", compact("user"));
    }

    public function update_mbak_kost(User $user, EditAccountRequest $request)
    {
        // User
        $data_user = $request->only("username", "email", "password");
        $data_user["password"] = bcrypt($request->password);
        $user->update($data_user);

        // Profile
        $data_profile = $request->except("username", "email", "password");
        $user->profile->update($data_profile);

        return redirect(route("home_admin"))->with("success", "Data User Berhasil di Update");
    }

    public function index_kamar_kost()
    {
        $kamar = KamarKost::paginate(3);
        return view("view.admin.kamar_kost.index", compact("kamar"));
    }

    public function tambah_kamar_kost()
    {
        return view("view.admin.kamar_kost.tambah");
    }

    public function store_kamar_kost(Request $request)
    {
        $kamar = KamarKost::create([
            "no_kamar" => $request->no_kamar,
            "harga" => $request->harga,
        ]);
        return redirect(route("index.kamar_kost"))->with("success", "Berhasil Menambahkan Data Kamar Kost");
    }

    public function edit_kamar_kost($no_kamar)
    {
        $kamar = KamarKost::where("no_kamar", $no_kamar)->first();
        return view("view.admin.kamar_kost.edit", compact("kamar"));
    }

    public function update_kamar_kost($no_kamar, Request $request)
    {
        $kamar = KamarKost::where("no_kamar", $no_kamar)->update([
            "no_kamar" => $request->no_kamar,
            "harga" => $request->harga,
        ]);
        return redirect(route("index.kamar_kost"))->with("success", "Data Kamar Kost Berhasil Diubah");
    }



}
