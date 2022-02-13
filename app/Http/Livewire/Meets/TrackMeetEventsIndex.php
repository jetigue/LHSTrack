<?php

namespace App\Http\Livewire\Meets;

use Livewire\Component;

class TrackMeetEventsIndex extends Component
{
    public $trackMeet;
    public $editing = false;
    public $showFormModal = false;

    protected $listeners = [
        'eventsUpdated' => '$refresh'
    ];

    public function addBoysRunningEventResults()
    {
        $this->showFormModal = true;
    }

    public function cancel()
    {
        $this->showFormModal = false;
        $this->editing = false;
    }

    public function render()
    {
        return view('livewire.meets.track-meet-events-index', [
            'boysEvents' => $this->trackMeet->boysTrackEvents
                ->withCount(['runningEventResults', 'fieldEventResults'])
                ->sortBy('distance_in_meters')
                ->sortBy('eventSubType.track_event_type_id'),

            'girlsEvents' => $this->trackMeet->girlsTrackEvents
                ->withCount(['runningEventResults', 'fieldEventResults'])
                ->sortBy('distance_in_meters')
                ->sortBy('eventSubType.track_event_type_id')
        ]);
    }
}
