<?php

namespace App\Http\Livewire\Meets\Track\Results;

use App\Models\Meets\Results\Track\TeamResult;
use App\Models\Meets\TrackMeet;
use Livewire\Component;

class TeamResultsIndex extends Component
{
    public TrackMeet $trackMeet;
    public $teamResult = '';
    public $editing = false;
    public $showFormModal = false;
    public $showConfirmModal = false;
    public $division;

    protected $listeners = [
        'hideFormModal',
        'showFormModal',
        'confirmDelete',
        'recordAdded',
        'recordUpdated'
    ];

    public function showFormModal()
    {
        $this->showFormModal = true;
    }

    public function hideFormModal()
    {
        $this->showFormModal = false;
    }

    public function recordAdded()
    {
        session()->flash('success', 'Result Added');
    }

    public function recordUpdated()
    {
        session()->flash('success', 'Result Updated');
    }

    public function confirmDelete(TeamResult $teamResult)
    {
        $this->teamResult = $teamResult;
        $this->showConfirmModal = true;
    }

    public function destroy(TeamResult $teamResult)
    {
        $this->teamResult = $teamResult;
        $this->teamResult->delete();
        $this->showConfirmModal = false;
        session()->flash('success', 'Result Deleted Successfully');
    }

    public function cancel()
    {
        $this->showFormModal = false;
        $this->editing = false;

        $this->emit('cancelCreate');
    }

    public function editRecord(TeamResult $teamResult)
    {
        $this->showFormModal = true;
        $this->editing = true;
        $this->emit('editTeamResult', $teamResult->id);
    }
    public function render()
    {
        return view('livewire.meets.track.results.team-results-index', [
            'teamResults'=> TeamResult::with('trackMeet', 'division')
                ->where('track_meet_id', $this->trackMeet->id)
                ->get()
        ]);
    }
}
