<?php

namespace App\Http\Livewire\Meets;

use App\Models\Meets\Results\Track\RelayEventResult;
use App\Models\Meets\TrackMeet;
use App\Models\Properties\Events\Track\TrackEvent;
use App\Models\Properties\Races\Gender;
use Livewire\Component;

class TrackMeetRelayEventResultsIndex extends Component
{
    public TrackEvent $trackEvent;
    public TrackMeet $trackMeet;
    public $result = '';
    public $editing = false;
    public $showFormModal = false;
    public $showConfirmModal = false;
    public $gender;

    protected $listeners = [
        'hideFormModal',
        'showFormModal',
        'confirmDelete',
        'recordAdded',
        'recordUpdated'
    ];

    public function mount()
    {
        if (str_contains(url()->current(), 'boys')) {
            $this->gender = Gender::firstWhere('id', 1);
        } else {
            $this->gender = Gender::firstWhere('id', 2);
        }
    }

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

    public function confirmDelete(RelayEventResult $result)
    {
        $this->result = $result;
        $this->showConfirmModal = true;
    }

    public function destroy(RelayEventResult $result)
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

    public function editRecord(RelayEventResult $result)
    {
        $this->showFormModal = true;
        $this->editing = true;
        $this->emit('editRelayEventResult', $result->id);
    }

    public function render()
    {
        return view('livewire.meets.track-meet-relay-event-results-index', [
            'results' => RelayEventResult::with('trackMeet', 'trackEvent')
                ->where('track_meet_id', $this->trackMeet->id)
                ->where('track_event_id', $this->trackEvent->id)
                ->where('gender_id', $this->gender->id)
                ->orderBy('place')
                ->get(),
        ]);
    }
}
