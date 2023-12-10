<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if(!Auth::guard('admins')->check(['email' => $request->email, 'password' => $request->password])){
            return redirect()->route('login');
        }
        if(Auth::guard('admins')->check(['email' => $request->email, 'password' => $request->password])){
            config(['session.lifetime' => 120]);
        }
        return $next($request);
    }
}
