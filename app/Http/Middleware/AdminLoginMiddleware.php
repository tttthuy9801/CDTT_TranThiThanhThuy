<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class AdminLoginMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!Auth::check()) {
            return redirect()->route('admin.getlogin'); //nguyen nhan chuyen hương trang
        } else {
            $user = Auth::user();
            if ($user->roles == 0) {
                Auth::postlogout();
                return redirect()->route('site.index');
            }
        }
        return $next($request);
    }
}
