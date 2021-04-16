<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Check_Authentication
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next, $role)
    {
        // Jika belum login maka akan di redirect ke halaman login
        if( !Auth::check() ) {
            return redirect( route("login") );
        }

        // Setelah berhasil Login, user akan di redirect ke halaman yang sesuai dengan role nya
        $user = Auth::user();
        if( $user->role == $role ) {
            return $next($request);
        }

        // Redirect ke log in page disertai pesan error jika kedua kondisi diatas tidak terpenuhi
        return redirect(route("login"))->with("error", "Akun yang diinputkan tidak ada!");
    }
}
