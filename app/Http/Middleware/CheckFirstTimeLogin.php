<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Password;

class CheckFirstTimeLogin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $admin = Auth::user();
        
        if ($admin->first_time_login) {
            $token = Password::broker('admins')->createToken($admin);
            return redirect(route('admin.password.reset', ['token' => $token, 'email' => $admin->email]));
        }

        return $next($request);
    }
}
