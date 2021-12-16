<?php

namespace App\Http\Livewire\Users;

use App\Models\Users\User;
use Livewire\Component;
use Livewire\WithPagination;

class UsersIndex extends Component
{
    use WithPagination;

        public $search = '';
        public $sortField = 'name';
        public $sortDirection = 'asc';
        public $user = '';
        public $editing = false;
        public $showFormModal = false;
        public $showConfirmModal = false;

        protected $queryString = ['sortField', 'sortDirection', 'search'];

        public function sortBy($field)
        {
            if ($this->sortField === $field) {
                $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
            } else {
                $this->sortDirection = 'asc';
            }

            $this->sortField = $field;
        }

        protected $listeners = [
            'hideFormModal',
            'showFormModal',
            'confirmDelete',
            'recordAdded',
            'recordUpdated'
        ];

        public function showFormModal() { $this->showFormModal = true; }
        public function hideFormModal() { $this->showFormModal = false; }

        public function clearSearch()
        {
            $this->reset('search');
        }

        public function recordAdded()
        {
            session()->flash('success', 'User Added');
        }

        public function recordUpdated()
        {
            session()->flash('success', 'User Updated');
        }

        public function confirmDelete(User $user)
        {
            $this->user = $user;
            $this->showConfirmModal = true;
            $this->user = $user;
        }

        public function destroy(User $user)
        {
            $this->user->delete();
            $this->showConfirmModal = false;
            session()->flash('success', 'User Deleted Successfully');
        }

        public function cancel()
        {
            $this->showFormModal = false;
            $this->editing = false;

            $this->emit('cancelCreate');
        }

        public function editRecord(User $user)
        {
            $this->showFormModal = true;
            $this->editing = true;
            $this->emit('editUser', $user->id);
        }

        public function render()
        {
            return view('livewire.users.users-index', [
                'users' => User::query()
                    ->where('name', 'like', '%' . $this->search . '%')
                    ->orwhere('email', 'like', '%' . $this->search . '%')
                    ->orderBy($this->sortField, $this->sortDirection)
                    ->orderBy('name')
                    ->paginate(25)
            ]);
        }
}
