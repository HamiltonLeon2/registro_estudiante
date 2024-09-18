<?php
namespace App\Enums;

abstract class PermissionTypes {
    const VER_USUARIOS = 'ver usuarios';
    const CREAR_USUARIOS = 'crear usuarios';
    const EDITAR_USUARIOS = 'editar usuarios';
    const ELIMINAR_USUARIOS = 'eliminar usuarios';
    const VER_ROLES = 'ver roles';
    const EDITAR_ROLES = 'editar roles';
    const CREAR_ROLES = 'crear roles';
    const REGISTRAR_POSTULANTE = 'registrar postulante';
    const EDITAR_POSTULANTE = 'editar postulante';
    const VER_POSTULANTE = 'ver postulantes';
    const ELIMINAR_POSTULANTE = 'eliminar postulante';  //De momento opcional solo para el administrador
}

