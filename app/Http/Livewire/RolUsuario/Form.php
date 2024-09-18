<?php

namespace App\Http\Livewire\RolUsuario;

use App\Models\Modulo;
use App\Models\ModuloPermiso;
use App\Models\EmpresaRol;
use Livewire\Component;
use Spatie\Permission\Models\Role;

class Form extends Component
{

  // component properties
  public $formMode;
  public $roleId;

  // form inputs
  public $name;

  // modulos y permisos
  public $modules;
  public $permissions=[];

  protected $rules = [
    'name' => 'required|unique:roles|min:3'
  ];

  public function mount()
  {
    if($this->formMode == 'edit'){
      $this->editData($this->roleId);
    }
  }

  public function render()
  {
    
    $this->modules = Modulo::with('permisos')->get();
    return view('livewire.rol-usuario.form')->layout('layouts.app');
  }

  public function createRole()
  {

    $this->validate();
    // reemplaza espacios por guines
    $this->name = strtr($this->name, ' ', '-');

    // pasa todo a minusculas
    $this->name = strtolower($this->name);

    $role = Role::create([
      'name' => $this->name,
      'guard_name' =>'web'
    ]);
    
    foreach ($this->permissions as $permission)
    {
        $role->givePermissionTo($permission['id']);
    }

    // send toast
    session()->flash('toast', ['success', 'Rol creado']);
    
    return redirect()->to(route('roles.index'));
  }

  public function updateRole()
  {
    $role = Role::where('id', $this->roleId)->first();

    // remover todos los permisos
    foreach($role->permissions as $permission) {
      $role->revokePermissionTo($permission['name']);  
    }

    // asociar nuevos permisos
    foreach ($this->permissions as $permission) {
      $role->givePermissionTo($permission['name']);
    }

    $this->name = strtr($this->name, ' ', '-');
    $this->name = strtolower($this->name);

    $role->name = $this->name;
    $role->save();

    // send toast
    session()->flash('toast', ['success', 'Rol actualizado']);

    return redirect()->route('roles.index');
  }

  public function editData($roleId)
  {
    $role = Role::find($roleId);
    foreach ($role->permissions->toArray() as $permission) {
      $element = [
        'id' => $permission['id'],
        'name' => $permission['name'],
        'guard_name' => $permission['guard_name'],
        'created_at' => $permission['created_at'],
        'updated_at' => $permission['updated_at'],
        'deleted_at' => $permission['deleted_at'],
      ];

      array_push($this->permissions, $element);

    }

    if($role->name == 'super-admin'){
      return redirect()->route('roles.index');
    }

    $this->name = $role->name;
  }

  public function handlePermission($permission)
  {
      $index = array_search($permission, $this->permissions);
  
      if ($index !== false) {
          unset($this->permissions[$index]);
      } else {
          $this->permissions[] = $permission;
      }
  }
  
  public function getModulesRole()
  {
      $permissionIds = \Auth::user()->getPermissionsViaRoles()->pluck('id')->toArray();
  
      $moduloIds = ModuloPermiso::whereIn('permiso_id', $permissionIds)->pluck('modulo_id')->toArray();
  
      $modulo_bd = Modulo::whereIn('id', $moduloIds)->with('permisos')->get();
  
      return $modulo_bd;
  }
  
}
