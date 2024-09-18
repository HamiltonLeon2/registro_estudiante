<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Log;

class LastLoginInformation
{
    //guardar la hora de ultima vez y direccion ip de ultimo ingreso

    public function handle($request, Closure $next)
    {
        $user = Auth::user();
        if ($user) {
            $lastLoginAt = $user->current_login_at;
            $user->last_login_at = $lastLoginAt;
            $user->current_login_at = now();
            $user->last_login_ip = $request->ip();
            $user->save();

            // Pasar $lastLoginAt a la vista
            view()->share('lastLoginAt', $lastLoginAt);
        }

        return $next($request);
    }
}
