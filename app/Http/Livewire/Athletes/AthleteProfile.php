<?php

namespace App\Http\Livewire\Athletes;

use App\Models\Athletes\Athlete;
use App\Models\Meets\Results\Track\FieldEventResult;
use App\Models\Meets\Results\Track\RelayEventResult;
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

            'fieldTrackEvents' => TrackEvent::query()
                ->whereHas('eventSubtype.eventType', function ($query) {
                    return $query->where('name', '=', 'Field');
                })->whereHas('fieldEventResults', function ($query) {
                    return $query->where('athlete_id', '=', $this->athlete->id);
                })->get(),

            'relayTrackEvents' => TrackEvent::query()
                ->whereHas('eventSubtype', function ($query) {
                    return $query->where('name', '=', 'Relays');
                })->whereHas('relayEventResults', function ($query) {
                    return $query->where('leg_1_athlete_id', '=', $this->athlete->id)
                    ->orWhere('leg_2_athlete_id', '=', $this->athlete->id)
                    ->orWhere('leg_3_athlete_id', '=', $this->athlete->id)
                    ->orWhere('leg_4_athlete_id', '=', $this->athlete->id);
                })->get(),

            'runningEventResults' => RunningEventResult::query()
                ->where('athlete_id', $this->athlete->id)->get(),

            'fieldEventResults' => FieldEventResult::query()
                ->where('athlete_id', $this->athlete->id)->get(),

            'relayEventResults' => RelayEventResult::query()
                ->where('leg_1_athlete_id', $this->athlete->id)
                ->orWhere('leg_2_athlete_id', $this->athlete->id)
                ->orWhere('leg_3_athlete_id', $this->athlete->id)
                ->orWhere('leg_4_athlete_id', $this->athlete->id)
                ->get(),
        ]);
    }
}
