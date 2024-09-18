<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Models\Permission;

class ModuloPermiso extends Model
{
  use HasFactory;

  protected $table = 'modulos_permisos';

  protected $fillable = [
    'modulo_id',
    'permiso_id'
  ];

  public function permiso()
  {
    return $this->belongsTo(Permission::class, 'permiso_id', 'id');
  }

  public function modulo()
  {
    return $this->belongsTo(Modulo::class, 'modulo_id', 'id');
  }
}
