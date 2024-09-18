<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Venturecraft\Revisionable\RevisionableTrait;

class Postulante extends Model
{
    use RevisionableTrait;
    use HasFactory;
    public $timestamps = false;
    protected $table = 'postulantes'; // Nombre de la tabla en la base de datos
    protected $primaryKey = 'id'; // Nombre de la clave primaria en la tabla

    protected $revisionEnabled = true;
    protected $revisionCleanup = true;
    protected $historyLimit = 500;
    protected $revisionFormattedFieldNames = [
        'nombreapellido' => 'Nombreapellido',
        'ente' => 'Ente',
        'cargo' => 'Cargo',
        'depa' => 'Depa',
    ];

    protected $fillable = [
        'nombreapellido',
        'ente',
        'cargo',
        'depa',

    ];

    // Relación con la tabla Estudiantes
    public function estudiante()
    {
        return $this->belongsTo(Estudiante::class, 'PERPOSTUID');
    }
    public function ente()
    {
        return $this->belongsTo(Ente::class, 'ente');
    }
 
    

}
