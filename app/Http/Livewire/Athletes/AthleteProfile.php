<?php

namespace App\Http\Livewire\Athletes;

use App\Models\Athletes\Athlete;
use App\Models\Meets\Results\Track\RunningEventResult;
use App\Models\Properties\Events\Track\TrackEvent;
use Livewire\Component;

class AthleteProfile extends Component
{
    public Athlete $athlete;

    public function render()
    {
        return view('livewire.athletes.athlete-profile', [
            'runningTrackEvents' => TrackEvent::query()
                ->whereHas('eventSubtype.eventType', function ($query) {
                return $query->where('name', '=', 'Running');
            })->whereHas('runningEventResults', function ($query) {
                return $query->where('athlete_id', '=', $this->athlete->id);
            })->get(),

            'runningTrackResults' => RunningEventResult::query()
                ->where('athlete_id', $this->athlete->id)->get()
        ]);
    }
}
