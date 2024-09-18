<?php

namespace App\Http\Livewire\RolUsuario;

use Livewire\Component;
use App\Models\EmpresaRol;
use Spatie\Permission\Models\Role;

class Index extends Component
{

  public $roleId;

  // event listener
  protected $listeners = ['deleteConfirmed' => 'deleteRole'];

  public function render()
  {
    return view('livewire.rol-usuario.index', [
      'roles' => Role::all()->take(5),'roles_aux' => Role::all(),
    ])->layout('layouts.app');
  }

  public function confirmDelete($encodedID) {
    $this->emit('confirmDelete');
    $this->roleId = base64_decode($encodedID);
  }

  public function deleteRole() {
    $role = Role::find($this->roleId);
    $role->delete();

    $this->emit('toast', ['warning', 'Rol eliminado']);

  }

}