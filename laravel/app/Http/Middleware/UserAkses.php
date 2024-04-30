<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserAkses
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
        if (Auth::guard('dokters')->check()) {
            // Jika pengguna masuk sebagai dokter
            // Lakukan sesuatu, seperti mengarahkan mereka ke dashboard dokter
            return $next($request);

        } elseif (Auth::guard('operators')->check()) {
            // Jika pengguna masuk sebagai operator
            // Lakukan sesuatu, seperti mengarahkan mereka ke dashboard operator
            return $next($request);

        } else {
            // Jika pengguna masuk sebagai pengguna biasa
            // Lakukan sesuatu, seperti mengarahkan mereka ke dashboard umum
            return $next($request);

        }
    }
}
