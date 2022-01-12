<?php

namespace App\Http\Livewire\Users;

use App\Models\Users\Role;
use Livewire\Component;

class UserRolesIndex extends Component
{
    public $userRole = '';
    public $editing = false;
    public $showFormModal = false;
    public $showConfirmModal = false;

    protected $listeners = [
        'hideFormModal',
        'showFormModal',
        'confirmDelete',
        'recordAdded',
        'recordUpdated'
    ];

    public function showFormModal() { $this->showFormModal = true; }
    public function hideFormModal() { $this->showFormModal = false; }

    public function recordAdded()
    {
        session()->flash('success', 'User Role Added');
    }

    public function recordUpdated()
    {
        session()->flash('success', 'User Role Updated');
    }

    public function confirmDelete(Role $userRole)
    {
        $this->userRole = $userRole;
        $this->showConfirmModal = true;
    }

    public function destroy(Role $userRole)
    {
        $this->userRole->delete();
        $this->showConfirmModal = false;
        session()->flash('success', 'Role Deleted Successfully');
    }

    public function cancel()
    {
        $this->showFormModal = false;
        $this->editing = false;

        $this->emit('cancelCreate');
    }

    public function editRecord(Role $userRole)
    {
        $this->showFormModal = true;
        $this->editing = true;
        $this->emit('editUserRole', $userRole->id);
    }

    public function render()
    {
        return view('livewire.users.user-roles-index', [
            'userRoles' => Role::all()
        ]);
    }
}
