<?php

namespace App\Http\Livewire\Properties\Races;

use App\Models\Properties\Races\Division;
use Livewire\Component;
use function view;

class DivisionsIndex extends Component
{
    public $division = '';
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
        session()->flash('success', 'Division Added');
    }

    public function recordUpdated()
    {
        session()->flash('success', 'Division Updated');
    }

    public function confirmDelete(Division $divisions)
    {
        $this->division = $divisions;
        $this->showConfirmModal = true;
    }

    public function destroy(Division $divisions)
    {
        $this->division->delete();
        $this->showConfirmModal = false;
        session()->flash('success', 'Division Deleted Successfully');
    }

    public function cancel()
    {
        $this->showFormModal = false;
        $this->editing = false;

        $this->emit('cancelCreate');
    }

    public function editRecord(Division $divisions)
    {
        $this->showFormModal = true;
        $this->editing = true;
        $this->emit('editDivision', $divisions->id);
    }

    public function render()
    {
        return view('livewire.properties.races.divisions-index', [
            'divisions' => Division::all()
        ]);
    }
}
