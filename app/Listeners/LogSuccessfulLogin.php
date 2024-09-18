<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Auth\Events\Login;
use Illuminate\Support\Facades\Request;
use carbon\carbon;

class LogSuccessfulLogin
{
    /**
     * Handle the event.
     *
     * @param  \Illuminate\Auth\Events\Login  $event
     * @return void
     */
    public function handle(Login $event)
    {
        $user = $event->user;

        // Guardar la hora de la sesión anterior
        $user->previous_login_at = $user->last_login_at;

        // Guardar la hora de inicio de sesión actual
        $user->last_login_at = Carbon::now();
        $user->save();
    }
}
