<?php

namespace App\Exports;

use App\Models\Ente;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class EntesExport implements FromCollection, WithHeadings, WithMapping
{
    protected $entes;
    protected $observaciones;
    protected $fecha;

    public function __construct($entes, $observaciones, $fecha)
    {
        $this->entes = $entes;
        $this->observaciones = $observaciones;
        $this->fecha = $fecha;
    }

    public function collection()
    {
        return $this->entes;
    }

    public function map($ente): array
    {
        return [
            $ente->id,
            $ente->ente,
            $ente->postulantes_count,
        ];
    }

    public function headings(): array
    {
        return [
            'ID',
            'Ente',
            'Postulados Registrados',
        ];
    }
}
