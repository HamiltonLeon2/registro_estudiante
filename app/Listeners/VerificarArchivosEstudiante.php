<?php

namespace App\Listeners;

use App\Events\EstudianteActualizado;
use Illuminate\Contracts\Queue\ShouldQueue;

class VerificarArchivosEstudiante implements ShouldQueue
{
    public function handle(EstudianteActualizado $event)
    {
        $estudiante = $event->getEstudiante();

        $estudiantes = Estudiante::all();
        $archivos = Archivo::all();
        $archivosRequeridos = [
            'Certificado OPSU',
            'Titulo de bachillerato',
            'Cedula de identidad',
            'Carta de postulacion',
        ];
        
        $archivosPorEstudiante = [];
    
        // Llenar el array $archivosPorEstudiante con los archivos de cada estudiante
        foreach ($estudiantes as $estudiante) {
            $archivosEstudiante = [];
            foreach ($archivos as $archivo) {
                if ($archivo->estudiante_id === $estudiante->id) {
                    $archivosEstudiante[] = $archivo->nombre;
                }
            }
            $archivosPorEstudiante[$estudiante->id] = $archivosEstudiante;
        }
    
        // Comparar los archivos de cada estudiante con los archivos requeridos
        foreach ($archivosPorEstudiante as $estudianteId => $archivosEstudiante) {
    
            $archivosFaltantes = array_diff($archivosRequeridos, $archivosEstudiante);
    
            if (empty($archivosFaltantes)) {

            } else {
                foreach ($archivosFaltantes as $archivoFaltante) {
                }
            }
        }
        // Utiliza la lógica que ya tienes para verificar los archivos y enviar notificaciones
    }
}
