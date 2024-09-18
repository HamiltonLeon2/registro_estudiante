<?php

namespace App\Http\Livewire\Usuario;

use Livewire\Component;
use Livewire\WithPagination;

class Create extends Component
{
  protected $paginationTheme = 'bootstrap';

  public function render()
  {
    return view('livewire.usuario.create')->layout('layouts.app');
  }
}
