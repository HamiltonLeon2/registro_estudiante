<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Archivo extends Model
{
    use HasFactory;

    protected $table = 'archivos'; // Nombre de la tabla en la base de datos
    protected $primaryKey = 'id'; // Nombre de la clave primaria en la tabla

    protected $fillable = [
        'nombre',
        'tipo',
        'size',
        'ruta',
        'estudiante_id',

    ];

    public function estudiante()
 {
     return $this->belongsTo(Estudiante::class);
}
}
