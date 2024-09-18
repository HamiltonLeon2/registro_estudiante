<?php

namespace App\Http\Livewire\PermisoRol;

use App\Models\Modulo;
use App\Models\ModuloPermiso;
use Livewire\Component;
use Spatie\Permission\Models\Permission;

class Index extends Component
{

  // TODO: HACER PAGINACION
  // TODO: HACER BUSCADOR

  // event listener
  protected $listeners = ['deleteConfirmed' => 'deletePermission'];
  
  public $filterModule;
  public $permissionId;


  public function render()
  {
    if(empty($this->filterModule)){
      $permissions = ModuloPermiso::with('permiso')->get();
    }else{
      $permissions = ModuloPermiso::where('modulo_id', $this->filterModule)->with(['permiso'])->get();
    }

    $modules = Modulo::all();

    return view('livewire.permiso-rol.index', [
      'permissions' => $permissions,
      'modules' => $modules
    ])->layout('layouts.app');
  }

  public function confirmDelete($encodedID) {
    $this->emit('confirmDelete');
    $this->permissionId = base64_decode($encodedID);
  }

  public function deletePermission() {
    
    $permission = ModuloPermiso::find($this->permissionId);
    $permission->delete();

    $spatiePermission = Permission::find($this->permissionId);
    $spatiePermission->delete();

    $this->emit('toast', ['warning', 'Permiso eliminado']);

  }

}
