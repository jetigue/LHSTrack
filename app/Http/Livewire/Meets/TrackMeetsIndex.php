<?php

namespace App\Http\Livewire\Meets;

use App\Models\Meets\TrackMeet;
use Livewire\Component;
use Livewire\WithPagination;

class TrackMeetsIndex extends Component
{
    use WithPagination;

    public $search = '';
    public $sortField = 'meet_date';
    public $sortDirection = 'desc';
    public $trackMeet = '';
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
        'refreshTrackMeets'
    ];

    public function showFormModal() { $this->showFormModal = true; }
    public function hideFormModal() { $this->showFormModal = false; }

    public function clearSearch()
    {
        $this->reset('search');
    }

    public function recordAdded()
    {
        session()->flash('success', 'Track Meet Added');
    }

    public function recordUpdated()
    {
        session()->flash('success', 'Track Meet Updated');
    }

    public function refreshTrackMeets()
    {
        session()->flash('success', 'Track Meets Imported Successfully');

        $this->render();

    }

    public function confirmDelete(TrackMeet $trackMeet)
    {
        $this->trackMeet = $trackMeet;
        $this->showConfirmModal = true;
    }

    public function destroy(TrackMeet $trackMeet)
    {
        $this->trackMeet->delete();
        $this->showConfirmModal = false;
        session()->flash('success', 'Track Meet Deleted Successfully');
    }

    public function cancel()
    {
        $this->showFormModal = false;
        $this->editing = false;

        $this->emit('cancelCreate');
    }

    public function editRecord(TrackMeet $trackMeet)
    {
        $this->showFormModal = true;
        $this->editing = true;
        $this->emit('editTrackMeet', $trackMeet->id);
    }

    public function render()
    {
        return view('livewire.meets.track-meets-index', [
            'trackMeets' => TrackMeet::with('meetName', 'host', 'timing', 'season', 'venue')
//                ->where('meetName.name', 'like', '%' . $this->search . '%')
//                ->orwhere('host.name', 'like', '%' . $this->search . '%')
                ->orderBy($this->sortField, $this->sortDirection)
                ->orderBy('meet_date')
                ->paginate(25)
        ]);
    }
}
