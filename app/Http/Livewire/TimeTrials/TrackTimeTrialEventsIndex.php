<?php

namespace App\Http\Livewire\TimeTrials;

use App\Models\Pivot\BoysTrackTimeTrialEvent;
use App\Models\Pivot\GirlsTrackTimeTrialEvent;
use Livewire\Component;
use function view;

class TrackTimeTrialEventsIndex extends Component
{
    public $timeTrial;

    protected $listeners = [
        'eventsUpdated' => '$refresh'
    ];

    public function render()
    {
        return view('livewire.time-trials.track-time-trial-events-index', [
            'girlsRaces' => GirlsTrackTimeTrialEvent::where('track_time_trial_id', $this->timeTrial->id)->get(),
            'boysRaces' => BoysTrackTimeTrialEvent::where('track_time_trial_id', $this->timeTrial->id)->get()
        ]);
    }
}
