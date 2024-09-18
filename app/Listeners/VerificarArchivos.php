<?php

namespace App\Listeners;

use App\Events\UserLoggedIn;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;

class CheckStudentFiles
{
    /**
     * Handle the event.
     *
     * @param \App\Events\UserLoggedIn $event
     * @return void
     */
    public function handle(UserLoggedIn $event)
    {
        $user = Auth::user();
        $studentFiles = $user->files;
        $requiredFiles = ['Carta de postulacion', 'cedula de identidad', 'Titulo de bachillerato', 'Certificado OPSU'];

        $missingFiles = [];
        foreach ($requiredFiles as $requiredFile) {
            if (!in_array($requiredFile, $studentFiles->pluck('name'))) {
                $missingFiles[] = $requiredFile;
            }
        }

        if (count($missingFiles) > 0) {
            $notification = new StudentMissingFilesNotification($user, $missingFiles);
            Notification::send($user, $notification);
        }
    }
}
