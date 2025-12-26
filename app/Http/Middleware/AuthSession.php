<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AuthSession
{
    public function handle(Request $request, Closure $next)
    {
        if (!$request->session()->has('token')) {
            return redirect('/login')->with('error', 'Silakan login dulu');
        }

        return $next($request);
    }
}
