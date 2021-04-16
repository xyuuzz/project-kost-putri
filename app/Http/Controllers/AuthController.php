<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login()
    {
        // Jika user sudah login, user tidak dapat mengakses halaman login
        if( Auth::user() ) {
            return redirect(route("home"));
        }

        return view("auth.login_rev");
    }

    public function auth_login(LoginRequest $request)
    {
        $data = $request->only("username", "password");

        if( Auth::attempt($data) )
        {
            // if( $request->remember ) {
            //     // setcookie("remember", rand() . Auth::id(), 3600*24*30);
            //     Cookie::queue("remember", bcrypt(Auth::user()->username), 3600*24*30);
            //     CookieSessionHandler
            // }
            // Ini admin
            if(Auth::user()->role == "admin") {
                return redirect()->intended(route("home_admin")); // Jika admin, kita redirect langsung ke haaman admin

            // Ini User
            } elseif (Auth::user()->role == "user") {
                return redirect()->intended("/"); // jika user kita redirect langsung ke halaman home
            }

        }

        // Ini error
        return redirect('login')
        ->withInput()
        ->withErrors(['failed_login' => 'Masukan Username dan Password dengan benar']);
    }

    public function logout(Request $request)
    {

        // Untuk menghilangkan session yang dibuat saat login
        $request->session()->flush();
        // Untuk logout
        Auth::logout();
        return redirect(route("login"));
    }
}
