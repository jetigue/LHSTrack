<?php

namespace App\Http\Livewire\Properties\Races;

use App\Models\Properties\Races\Gender;
use Livewire\Component;
use function view;

class GendersIndex extends Component
{
    public $gender = '';
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
        session()->flash('success', 'Gender Added');
    }

    public function recordUpdated()
    {
        session()->flash('success', 'Gender Updated');
    }

    public function confirmDelete(Gender $gender)
    {
        $this->gender = $gender;
        $this->showConfirmModal = true;
    }

    public function destroy(Gender $gender)
    {
        $this->gender->delete();
        $this->showConfirmModal = false;
        session()->flash('success', 'Gender Deleted Successfully');
    }

    public function cancel()
    {
        $this->showFormModal = false;
        $this->editing = false;

        $this->emit('cancelCreate');
    }

    public function editRecord(Gender $gender)
    {
        $this->showFormModal = true;
        $this->editing = true;
        $this->emit('editGender', $gender->id);
    }

    public function render()
    {
        return view('livewire.properties.races.genders-index', [
            'genders' => Gender::orderBy('name')->get()
        ]);
    }
}
