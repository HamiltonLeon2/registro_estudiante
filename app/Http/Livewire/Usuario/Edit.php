<?php

namespace App\Http\Livewire\Usuario;

use Livewire\Component;

class Edit extends Component
{
  public $userId;

  public function mount($id){
    $this->userId = $id;
  }

  public function render()
  {
    return view('livewire.usuario.edit')->layout('layouts.app');
  }
}
