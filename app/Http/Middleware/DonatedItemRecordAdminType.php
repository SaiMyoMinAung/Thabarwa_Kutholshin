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
        $type = auth()->user()->typeOfAdmin;
        
        if ($type && $type->name != DONATED_ITEM_RECORD_ADMIN) {
            return redirect('login');
        }

        return $next($request);
    }
}
