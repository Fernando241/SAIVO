<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class UsersIndex extends Component
{
    use WithPagination;

    public $search = '';
    public $users;

    public function mount()
    {
        // Cargar todos los usuarios al iniciar
        $this->users = User::all();
    }

    public function buscarUsuarios()
    {
        if ($this->search == '') {
            $this->users = User::all();
        } else {
            $this->users = User::where('name', 'LIKE', '%' . $this->search . '%')
                ->orWhere('email', 'LIKE', '%' . $this->search . '%')
                ->get();
        }
    }

    public function render()
    {
        $user = User::where('name', 'LIKE', '%' . $this->search . '%')
            ->orWhere('email', 'LIKE', '%' . $this->search . '%')
            ->paginate();

        return view('livewire.users-index', compact('user'));
    }
}