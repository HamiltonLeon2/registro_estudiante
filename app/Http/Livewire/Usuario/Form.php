<?php

namespace App\Http\Livewire\Usuario;

use App\Models\User;
use Livewire\Component;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Auth;

class Form extends Component
{
    public $name;
    public $email;
    public $password;
    public $password_confirmation;
    public $rolUsuario;
    public $userRoles;
    public $user;

    // Component parameters
    public $mode;
    public $userId;

    protected $rules = [
        'name' => 'required|unique:users',
        'email' => 'email',
        'password' => 'required|confirmed',
        'rolUsuario' => 'required'
    ];

    protected $messages = [
        'name.required' => 'El "nombre" no debe estar vacío',
        'name.unique' => 'El "Nombre" de usuario ya esta registrado',
        'password.required' => 'La "contraseña" no debe estar vacío',
        'rolUsuario.required' => 'El "rol" no debe estar vacío',
        'password.confirmed' => 'La contraseña debe coincidir',
    ];

    public function mount()
    {
        if ($this->mode == 'edit') {
            $this->editUserData($this->userId);
        }

        $this->userRoles = Role::all();
    }

    public function render()
    {
        return view('livewire.usuario.form');
    }

    public function crearUsuario()
    {
        $this->validate([
            'name'=> 'required|unique:users',
            'email' => 'email|nullable|nullable,email',
            'password' => 'required|confirmed|min:6',
            'rolUsuario' => 'required'
        ], [
            'name.unique' => 'El nombre de usuario ya está en uso.',
            'password.min' => 'La contraseña debe tener mínimo 6 carácteres'
        ]);
    
        $usuario = User::create([
            'name' => $this->name,
            'email' => $this->email,
            'password' => Hash::make($this->password),
        ]);
    
        $usuario->assignRole($this->rolUsuario);
        $url = route('usuarios.index');
        $this->emit('toast_aux', ['success', 'Creado correctamente', $url]);
    }  

    public function editUserData($userId)
    {
        $this->user = User::with('roles')->where('id', $userId)->first();
        $this->name = $this->user->name;
        $this->email = $this->user->email;
        $this->rolUsuario = $this->user->getRoleNames()->first();
    }

    public function updateUser()
    {

        $user = Auth::user();
        $url = '';

        $this->validate([
            'rolUsuario' => 'required',
            'name' => ['required', 'unique:users,name,' . $this->user->id, 'string', 'max:255'],
            'password' => 'nullable|confirmed|min:6'
        ], [
            'name.unique' => 'El nombre de usuario ya está en uso.',
            'password.min' => 'La contraseña debe tener mínimo 6 carácteres.'

        ]);
        $this->user->name = $this->name;
        

        if($this->user->getRoleNames()->first())
        {
            $this->user->removeRole($this->user->getRoleNames()->first());
        }
        $this->user->assignRole($this->rolUsuario);
    
        if (!empty($this->password)) {
            if ($this->password != $this->password_confirmation) {
                $this->emit('toast', ['warning', 'Las contraseñas no coinciden']);
                return;
            }
    
            $this->user->password = Hash::make($this->password);
        }
    
        $this->user->save();

        if ($user->hasRole('administrador')) {
            $url = route('usuarios.index');
        } elseif ($user->hasRole('personal-de-ingreso')){
            $url = route('estudiantes.search');
        }
        
    

        $this->emit('toast_aux', ['success', 'Actualizado correctamente', $url]);
    }
   
}

