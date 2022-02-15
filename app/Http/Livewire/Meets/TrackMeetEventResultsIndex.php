<?php

namespace App\Http\Livewire\Meets;

use App\Models\Meets\TrackMeet;
use App\Models\Properties\Events\Track\TrackEvent;
use App\Models\Properties\Races\Gender;
use Livewire\Component;

class TrackMeetEventResultsIndex extends Component
{
    public TrackEvent $trackEvent;
    public TrackMeet $trackMeet;
    public $gender;


    public function mount()
    {
        if (str_contains(url()->current(), 'boys'))
        {
            $this->gender = Gender::firstWhere('id', 1);
        } else {
            $this->gender = Gender::firstWhere('id', 2);
        }
    }

    public function render()
    {
        return view('livewire.meets.track-meet-event-results-index', [
            'boysEvents' => $this->trackMeet->boysTrackEvents,
//                ->sortBy('distance_in_meters'),

            'girlsEvents' => $this->trackMeet->girlsTrackEvents,
//                ->sortBy('distance_in_meters'),

        ]);
    }
}
