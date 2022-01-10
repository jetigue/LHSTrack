<?php

namespace App\Http\Livewire\Properties\Meets;

use App\Models\Properties\Meets\Timing;
use Livewire\Component;

class TimingMethodsIndex extends Component
{
    public $timingMethod = '';
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
        session()->flash('success', 'Timing Method Added');
    }

    public function recordUpdated()
    {
        session()->flash('success', 'Timing Method Updated');
    }

    public function confirmDelete(Timing $timingMethod)
    {
        $this->timingMethod = $timingMethod;
        $this->showConfirmModal = true;
    }

    public function destroy(Timing $timingMethod)
    {
        $this->timingMethod->delete();
        $this->showConfirmModal = false;
        session()->flash('success', 'Timing Method Deleted Successfully');
    }

    public function cancel()
    {
        $this->showFormModal = false;
        $this->editing = false;

        $this->emit('cancelCreate');
    }

    public function editRecord(Timing $timingMethod)
    {
        $this->showFormModal = true;
        $this->editing = true;
        $this->emit('editTimingMethod', $timingMethod->id);
    }

    public function render()
    {
        return view('livewire.properties.meets.timing-methods-index', [
            'timingMethods' => Timing::orderBy('name')->get()
        ]);
    }
}
