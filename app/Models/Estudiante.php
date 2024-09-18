<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

use Illuminate\Database\Eloquent\Model;


class Estudiante extends Model
{
    use HasFactory;
    use RevisionableTrait;

    protected $revisionEnabled = true;
    protected $revisionCleanup = true;
    protected $historyLimit = 500;
    protected $revisionFormattedFieldNames = [
        'cedula' => 'Cedula',
        'nombre' => 'Nombre',
        'apellido' => 'Apellido',
        'mail' => 'Mail',
        'num1' => 'Num1',
        'num2' => 'Num2',
        'num3' => 'Num3',
        'tipp' => 'tipp',
        'notas' => 'notas',
    ];
    protected $table = 'estudiantes'; // Nombre de la tabla en la base de datos
    protected $primaryKey = 'id';
    protected $fillable = ['cedula',
                            'nombre',
                            'apellido', 
                            'mail', 
                            'num1', 
                            'num2', 
                            'num3', 
                            'tipp', 
                            'notas']; 
    
    public function postulante()
    {
        return $this->hasOne(Postulante::class, 'id');
    }
 public function archivo()
 {
     return $this->hasmany(Archivo::class);
}
public function ente()
{
    return $this->hasOneThrough(Ente::class, Postulante::class, 'id', 'id', 'postulante', 'ente');
}
}
