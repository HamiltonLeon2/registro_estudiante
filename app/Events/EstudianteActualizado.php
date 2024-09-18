<?php

namespace App\Events;

use App\Models\Estudiante;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class EstudianteActualizado
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    protected $estudiante;

    public function __construct(Estudiante $estudiante)
    {
        $this->estudiante = $estudiante;
    }

    public function getEstudiante()
    {
        return $this->estudiante;
    }
}
