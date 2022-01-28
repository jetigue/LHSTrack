<?php

namespace App\Http\Livewire\Users;

use App\Models\Users\Role;
use Livewire\Component;

class UserRoleForm extends Component
{
    public $userRole = null;
    public $name;

    protected $listeners = [
        'cancelCreate' => 'resetForm',
        'submitCreate' => 'submitForm',
        'editUserRole'
    ];

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function editUserRole(Role $userRole)
    {
        $this->userRole = $userRole;
        $this->name = $this->userRole->name;
    }

    public function rules()
    {
        return [
            'name' => 'required|string|max:50',
        ];
    }

    public function submitForm()
    {
        $this->validate();

        $userRole = [
            'name' => $this->name,
        ];

        if ($this->userRole) {
            Role::find($this->userRole->id)->update($userRole);
            $this->emit('recordUpdated');
        } else {
            Role::create($userRole);
            $this->emit('recordAdded');
        }
        $this->resetForm();
        $this->emit('hideFormModal');
    }

    public function resetForm()
    {
        $this->reset(['name']);
    }

    public function render()
    {
        return view('livewire.users.user-role-form');
    }
}
