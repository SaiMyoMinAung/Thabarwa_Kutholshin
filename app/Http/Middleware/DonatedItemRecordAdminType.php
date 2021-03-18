<?php

namespace App\Http\Middleware;

use Closure;

class DonatedItemRecordAdminType
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
        $type = auth()->user()->typeOfAdmins;

        if (
            $type->where('name', DONATED_ITEM_RECORD_ADMIN)->count() == 0
            && !auth()->user()->is_super
        ) {
            return redirect(route('admin.login'));
        }

        return $next($request);
    }
}
