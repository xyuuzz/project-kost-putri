<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class Midtrans
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
        // Untuk midtrans
        \Midtrans\Config::$serverKey = 'SB-Mid-server-RxFsjOPyzQvHuv8wYnMsGf2K';
        // Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
        \Midtrans\Config::$isProduction = false;
        // Set sanitization on (default)
        \Midtrans\Config::$isSanitized = true;
        // Set 3DS transaction for credit card to true
        \Midtrans\Config::$is3ds = true;

        return $next($request);
    }
}
