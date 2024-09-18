<?php
// app/Models/Ente.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ente extends Model
{
    use HasFactory;

    protected $table = 'ente'; // Nombre de la tabla en la base de datos
    protected $primaryKey = 'id'; // Nombre de la clave primaria en la tabla
    protected $fillable = ['ente']; 

    public function postulantes()
{
    return $this->hasMany(Postulante::class, 'ente');
}
}
