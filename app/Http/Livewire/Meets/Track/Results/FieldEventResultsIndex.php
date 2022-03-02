<?php

namespace App\Http\Livewire\Meets\Track\Results;

use App\Models\Meets\Results\Track\FieldEventResult;
use App\Models\Meets\Results\Track\TeamResult;
use App\Models\Properties\Events\Track\TrackEvent;
use App\Models\Properties\Races\Gender;
use Livewire\Component;
use function session;
use function view;

class FieldEventResultsIndex extends Component
{
    public TrackEvent $trackEvent;
    public TeamResult $teamResult;
    public $result = '';
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

    public function confirmDelete(FieldEventResult $result)
    {
        $this->result = $result;
        $this->showConfirmModal = true;
    }

    public function destroy(FieldEventResult $result)
    {
        $this->result = $result;
        $this->result->delete();
        $this->showConfirmModal = false;
        session()->flash('success', 'Result Deleted Successfully');
    }

    public function cancel()
    {
        $this->showFormModal = false;
        $this->editing = false;

        $this->emit('cancelCreate');
    }

    public function editRecord(FieldEventResult $result)
    {
        $this->showFormModal = true;
        $this->editing = true;
        $this->emit('editFieldEventResult', $result->id);
    }

    public function render()
    {
        return view('livewire.meets.track.results.field-event-results-index', [
            'results' => FieldEventResult::with('teamResult', 'athlete', 'trackEvent')
                ->where('track_team_result_id', $this->teamResult->id)
                ->where('track_event_id', $this->trackEvent->id)
                ->orderBy('place')
                ->get(),
        ]);
    }
}
