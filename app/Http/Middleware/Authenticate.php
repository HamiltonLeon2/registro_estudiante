<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    protected function redirectTo($request)
    {
        if (! $request->expectsJson()) {
           /* $user = Auth::user();
            $user->previus_login_at = $user->last_login_at;
            $user->last_login_at = Carbon::now();
            $user-> save();*/

            return route('login');
        }
    }
}
