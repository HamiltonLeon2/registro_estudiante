<?php

namespace App\Http\Livewire\PermisoRol;

use App\Models\Modulo;
use App\Models\ModuloPermiso;
use Livewire\Component;
use Spatie\Permission\Models\Permission;

class Form extends Component
{
  public $permissions;
  public $moduleChoosenId = "";
  public $moduleChoosenPermissions = [];
  public $showModulePermissions = false;
  public $newModulePermissions = [];
  public $newModulePermission;
  public $storedModulePermissions = [];

  public function mount()
  {
    //
  }

  public function render()
  {
    return view('livewire.permiso-rol.form', [
      'modules' => Modulo::all()
    ])->layout('layouts.master');
  }

  public function loadModulePermissions()
  {
    $this->moduleChoosenPermissions = ModuloPermiso::where('modulo_id', $this->moduleChoosenId)->with('permiso')->get();

    foreach ($this->moduleChoosenPermissions as $module) {
      array_push($this->storedModulePermissions, $module->permiso->name);
    }

    $this->showModulePermissions = true;
    $this->newModulePermissions = [];
  }

  public function addPermissionToArray()
  {

    // validate is not empty
    if($this->newModulePermission == ""){
      return $this->emit('toast', ['error', 'Permiso no válido']);
    }

    $permissionToLowerCase = strtolower($this->newModulePermission);
    $storedPermission = Permission::where([
      'name' => $permissionToLowerCase,
      'deleted_at' => 'NULL'
    ])->get();

    if(count($storedPermission) > 0){
      return $this->emit('toast', ['error', 'Permiso pertenece a otro modulo']);
    }

    if(in_array($permissionToLowerCase, $this->storedModulePermissions) || in_array($permissionToLowerCase, $this->newModulePermissions))
    {
      return $this->emit('toast', ['error', 'Permiso duplicado']);
    }

    array_push($this->newModulePermissions, $permissionToLowerCase);
    $this->newModulePermission = "";
  }

  public function removePermissionFromArray($element)
  {
    $elementIndex = array_search($element, $this->newModulePermissions);
    array_splice($this->newModulePermissions, $elementIndex, 1);
  }

  public function createPermissions()
  {
    foreach ($this->newModulePermissions as $newPermission) {

      $permission = Permission::create([
        'name' => $newPermission
      ]);

      ModuloPermiso::create([
        'modulo_id' => $this->moduleChoosenId,
        'permiso_id' => $permission->id
      ]);
    }

    session()->flash('toast', ['success', 'Permisos asociados']);
    return redirect()->route('permisos.index');
  }

}
