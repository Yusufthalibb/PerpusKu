<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class IsAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Jika user login dan rolenya admin, lanjutkan request
        if (Auth::check() && Auth::user()->role == 'admin') {
            return $next($request);
        }

        // Jika tidak, arahkan ke halaman dashboard umum (atau bisa juga ke halaman 'forbidden')
        return redirect('/dashboard')->with('error', 'Anda tidak memiliki akses ke halaman Administrator.');
    }
}   