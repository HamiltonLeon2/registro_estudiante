<?php

use Illuminate\Support\Facades\Route;


use App\Http\Livewire\Usuario\Create as UsuarioCreate;
use App\Http\Livewire\Usuario\Index as UsuarioIndex;
use App\Http\Livewire\Usuario\Edit as UsuarioEdit;

use App\Http\Livewire\RolUsuario\Index as RolUsuarioIndex;
use App\Http\Livewire\RolUsuario\Edit as RolUsuarioEdit;
use App\Http\Livewire\RolUsuario\Create as RolUsuarioCreate;

use App\Http\Livewire\PermisoRol\Index as PermisoRolIndex;
use App\Http\Livewire\PermisoRol\Edit as PermisoRolEdit;
use App\Http\Livewire\PermisoRol\Create as PermisoRolCreate;

use App\Http\Livewire\Modulo\Index as ModuloIndex;
use App\Http\Livewire\Modulo\Edit as ModuloEdit;
use App\Http\Livewire\Modulo\Create as ModuloCreate;

use App\Http\Controllers\EstudianteController;
use App\Http\Controllers\ExportController;
use App\Http\Controllers\Entescontroller;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
  return view('auth.login');
});

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
  return redirect()->route('estudiantes.search');
});


Route::middleware(['auth:sanctum', 'verified'])->group(function () {
  Route::middleware(['excludeRole'])->group(function () {
    //usuarios
    Route::get('/usuarios', UsuarioIndex::class)->name('usuarios.index');
    Route::get('/usuarios/nuevo', UsuarioCreate::class)->name('usuarios.nuevo');
    Route::get('/usuarios/editar/{id}', UsuarioEdit::class)->name('usuarios.editar');

    //rol usuario
    Route::get('/roles', RolUsuarioIndex::class)->name('roles.index');
    Route::get('/roles/nuevo', RolUsuarioCreate::class)->name('roles.nuevo');
    Route::get('/roles/editar/{id}', RolUsuarioEdit::class)->name('roles.editar');
    Route::get('/auditoria', [EstudianteController::class, 'mostrarHistorial'])->name('auditoria');
  });
  //rutas correspondientes al sistema de postulación
  Route::get('/buscador', [EstudianteController::class, 'searching'])->name('estudiantes.search');
  Route::get('/buscar', [EstudianteController::class, 'buscar'])->name('buscar');
  Route::get('/registro-estudiante', [EstudianteController::class, 'create'])->name('estudiantes.create');
  Route::post('/registro-estudiante', [EstudianteController::class, 'store'])->name('estudiantes.store');
  Route::get('/editar-estudiante/{id}', [EstudianteController::class, 'edit'])->name('estudiantes.edit');
  Route::post('/editar-estudiante/{id}', [EstudianteController::class, 'update'])->name('estudiantes.update');
  Route::put('editar-estudiante/{id}', [EstudianteController::class, 'update'])->name('estudiantes.update');
  Route::get('/datatable', [EstudianteController::class, 'showDatatable'])->name('datatable.show');
  Route::get('/todos-postulados', [EstudianteController::class, 'showtodos'])->name('estudiantes.todos');
  Route::get('/perfil/{id}', [EstudianteController::class, 'mostrarPerfil'])->name('perfil.show');
  Route::get('/revision-archivos', [EstudianteController::class, 'RevArchivos'])->name('revisionArchivos.show');
  Route::get('archivos/{nombreArchivo}', [EstudianteController::class, 'descargarArchivo'])->name('descargar.archivo');

  //Mensaje de error archivos no encontrado
  Route::get('/error/archivos-no-encontrados', function () {
    return view('error.archivos_no_encontrados');
  })->name('error.archivos_no_encontrados');
  //Rutas referente con los postulantes
  Route::get('/postulantes/CrearEnte', [Entescontroller::class, 'index'])->name('postulantes.crear');
  Route::post('/postulantes/CrearEnte', [Entescontroller::class, 'store'])->name('postulantes.store');
  Route::post('/upload-csv', [Entescontroller::class, 'uploadCSV'])->name('upload.csv');
  Route::get('/postulantes/entes', [Entescontroller::class, 'view'])->name('entes.view');
  //Rutas para exportar
  Route::get('/totales', [EstudianteController::class, 'mostrarTotales'])->name('totales.show');
  Route::get('/totalesYear', [EstudianteController::class, 'totalYear'])->name('totalesYear.show');
  Route::get('/totalestipos-postulacion', [EstudianteController::class, 'totaltipp'])->name('totalestipp.show');;
  Route::post('/exportar/excel', [ExportController::class, 'exportExcel'])->name('exportar.excel');
  Route::get('/exports-pdf', [ExportController::class, 'pdf']);
  Route::post('/exportar/pdf', [ExportController::class, 'pdf'])->name('exportar.pdf');
});
