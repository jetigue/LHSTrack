<?php

namespace App\Http\Livewire\TimeTrials;

use App\Models\TimeTrials\TrackTimeTrial;
use Illuminate\Support\Facades\Route;
use Livewire\Component;
use Livewire\WithPagination;

class TrackTimeTrialsIndex extends Component
{
    use WithPagination;

    public $search = '';

    public $sortField = 'trial_date';

    public $sortDirection = 'desc';

    public $timeTrial = '';

    public $editing = false;

    public $showFormModal = false;

    public $showConfirmModal = false;

    public $route;

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
        'refreshTimeTrials',
    ];

    public function mount()
    {
        $this->route = Route::currentRouteName();
    }

    public function showFormModal()
    {
        $this->showFormModal = true;
    }

    public function hideFormModal()
    {
        $this->showFormModal = false;
    }

    public function clearSearch()
    {
        $this->reset('search');
    }

    public function recordAdded()
    {
        session()->flash('success', 'Time Trial Added');
    }

    public function recordUpdated()
    {
        session()->flash('success', 'Time Trial Updated');
    }

    public function refreshTrackTimeTrials()
    {
        session()->flash('success', 'Time Trials Imported Successfully');

        $this->render();
    }

    public function confirmDelete(TrackTimeTrial $timeTrial)
    {
        $this->timeTrial = $timeTrial;
        $this->showConfirmModal = true;
    }

    public function destroy(TrackTimeTrial $timeTrial)
    {
        $this->timeTrial->delete();
        $this->showConfirmModal = false;
        session()->flash('success', 'Time Trial Deleted Successfully');
    }

    public function cancel()
    {
        $this->showFormModal = false;
        $this->editing = false;

        $this->emit('cancelCreate');
    }

    public function editRecord(TrackTimeTrial $timeTrial)
    {
        $this->showFormModal = true;
        $this->editing = true;
        $this->emit('editTrackTimeTrial', $timeTrial->id);
    }

    public function render()
    {
        return view('livewire.time-trials.track-time-trials-index', [
            'timeTrials' => TrackTimeTrial::with('venue', 'timingMethod')
                ->where('name', 'like', '%'.$this->search.'%')
                ->orderBy($this->sortField, $this->sortDirection)
                ->orderBy('trial_date')
                ->paginate(25),
        ]);
    }
}
