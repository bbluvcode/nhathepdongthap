<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Session;

class AuthMiddelware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $accountConfirmOTP = Session::get('accountConfirmOTP');
        if (!$accountConfirmOTP) {
            return redirect("/login")->with("message", "Vui long dang nhap");
        } 
         return $next($request);
    }
}
