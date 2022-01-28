<?php

namespace App\Http\Livewire\Properties\Races;

use App\Models\Properties\Races\Level;
use Livewire\Component;
use function view;

class LevelsIndex extends Component
{
    public $level = '';
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
        session()->flash('success', 'Level Added');
    }

    public function recordUpdated()
    {
        session()->flash('success', 'Level Updated');
    }

    public function confirmDelete(Level $level)
    {
        $this->level = $level;
        $this->showConfirmModal = true;
    }

    public function destroy(Level $level)
    {
        $this->level->delete();
        $this->showConfirmModal = false;
        session()->flash('success', 'Level Deleted Successfully');
    }

    public function cancel()
    {
        $this->showFormModal = false;
        $this->editing = false;

        $this->emit('cancelCreate');
    }

    public function editRecord(Level $level)
    {
        $this->showFormModal = true;
        $this->editing = true;
        $this->emit('editLevel', $level->id);
    }

    public function render()
    {
        return view('livewire.properties.races.levels-index', [
            'levels' => Level::orderBy('name')->get()
        ]);
    }
}
