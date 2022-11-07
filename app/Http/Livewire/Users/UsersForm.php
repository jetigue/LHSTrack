<?php

namespace App\Http\Livewire\Users;

use App\Models\Users\Role;
use App\Models\Users\User;
use Livewire\Component;

class UsersForm extends Component
{
    public $user = null;

    public $user_role_id;

    protected $listeners = [
        'cancelCreate' => 'resetForm',
        'submitCreate' => 'submitForm',
        'editUser',
    ];

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function editUser(User $user)
    {
        $this->user = $user;
        $this->user_role_id = $this->user->user_role_id;
    }

    public function rules()
    {
        return [
            'user_role_id' => 'required|integer',
        ];
    }

    public function submitForm()
    {
        $this->validate();

        $user = [
            'user_role_id' => $this->user_role_id,
        ];

        if ($this->user) {
            User::find($this->user->id)->update($user);
            $this->emit('recordUpdated');
        }

        $this->resetForm();
        $this->emit('hideFormModal');
    }

    public function resetForm()
    {
        $this->reset(['user_role_id']);
    }

    public function render()
    {
        return view('livewire.users.users-form', [
            'userRoles' => Role::all(),
        ]);
    }
}
