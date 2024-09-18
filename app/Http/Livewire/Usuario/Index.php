<?php

namespace App\Http\Livewire\Usuario;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    // Pagination config
    public $resultsPerPage = 10;
    protected $paginationTheme = 'bootstrap';

    // Event listener
    protected $listeners = [
        'deleteConfirmed' => 'deleteUser'
    ];

    public $userId;
    public $search = '';

    public function updatingResultsPerPage()
    {
        $this->resetPage();
    }

    public function render()
    {
        $usuarios = User::where('name', 'LIKE', "%{$this->search}%")
            ->orWhere('email', 'LIKE', "%{$this->search}%")
            ->paginate($this->resultsPerPage);

        return view('livewire.usuario.index', compact('usuarios'))
            ->layout('layouts.app');
    }

    public function confirmDelete($encodedID)
    {
        $this->emit('confirmDelete');
        $this->userId = base64_decode($encodedID);
    }

    public function deleteUser()
    {
        User::findOrFail($this->userId)->delete();
        $this->emit('toast', ['success', 'Usuario eliminado correctamente']);
        $this->resetPage();
    }
}
