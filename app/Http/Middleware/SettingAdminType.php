<?php

namespace App\Http\Middleware;

use Closure;

class SettingAdminType
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
        $type = auth()->user()->typeOfAdmin;

        if ($type && $type->name != SETTING) {
            return redirect(route('admin.login'));
        }

        return $next($request);
    }
}
