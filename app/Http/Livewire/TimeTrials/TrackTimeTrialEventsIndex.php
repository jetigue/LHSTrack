<?php

namespace App\Http\Livewire\TimeTrials;

use Livewire\Component;

class TrackTimeTrialEventsIndex extends Component
{
    public $timeTrial;
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

//        $this->emit('cancelCreate');
    }

    public function render()
    {
        return view('livewire.time-trials.track-time-trial-events-index', [
            'boysEvents' => $this->timeTrial->boysTrackEvents
                ->sortBy('distance_in_meters')
                ->sortBy('eventSubType.track_event_type_id'),

            'girlsEvents' => $this->timeTrial->girlsTrackEvents
                ->sortBy('distance_in_meters')
                ->sortBy('eventSubType.track_event_type_id')
        ]);
    }
}
