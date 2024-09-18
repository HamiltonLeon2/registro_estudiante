<?php

namespace App\Http\Livewire\RolUsuario;

use Livewire\Component;

class Edit extends Component
{
  public $roleId;

  public function mount($id){
    $this->roleId = $id;
  }

  public function render()
  {
    return view('livewire.rol-usuario.edit')->layout('layouts.app');
  }
}
