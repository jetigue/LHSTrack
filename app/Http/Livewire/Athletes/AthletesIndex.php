<?php

namespace App\Http\Livewire\Athletes;

use App\Models\Athletes\Athlete;
use App\Traits\withSorting;
use Livewire\Component;
use Livewire\WithPagination;

class AthletesIndex extends Component
{
    use WithPagination;

    public $search = '';
    public $sortField = 'last_name';
    public $sortDirection = 'asc';
    public $athlete = '';
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
        'recordUpdated',
        'refreshAthletes'
    ];

    public function showFormModal() { $this->showFormModal = true; }
    public function hideFormModal() { $this->showFormModal = false; }

    public function clearSearch()
    {
        $this->reset('search');
    }

    public function recordAdded()
    {
        session()->flash('success', 'Athlete Added');
    }

    public function recordUpdated()
    {
        session()->flash('success', 'Athlete Updated');
    }

    public function refreshAthletes()
    {
        session()->flash('success', 'Athletes Imported Successfully');

        $this->render();

    }

    public function confirmDelete(Athlete $athlete)
    {
        $this->athlete = $athlete;
        $this->showConfirmModal = true;
//        $this->athlete = $athlete;
    }

    public function destroy(Athlete $athlete)
    {
        $this->athlete->delete();
        $this->showConfirmModal = false;
        session()->flash('success', 'Athlete Deleted Successfully');
    }

    public function cancel()
    {
        $this->showFormModal = false;
        $this->editing = false;

        $this->emit('cancelCreate');
    }

    public function editRecord(Athlete $athlete)
    {
        $this->showFormModal = true;
        $this->editing = true;
        $this->emit('editAthlete', $athlete->id);
    }

    public function render()
    {
        return view('livewire.athletes.athletes-index', [
            'athletes' => Athlete::query()
                ->where('first_name', 'like', '%' . $this->search . '%')
                ->orwhere('last_name', 'like', '%' . $this->search . '%')
                ->orderBy($this->sortField, $this->sortDirection)
                ->orderBy('last_name')
                ->paginate(25)
        ]);
    }
}
