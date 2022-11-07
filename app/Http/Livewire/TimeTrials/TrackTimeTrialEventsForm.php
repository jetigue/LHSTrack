<?php

namespace App\Http\Livewire\TimeTrials;

use App\Models\Properties\Events\Track\TrackEventType;
use Livewire\Component;

class TrackTimeTrialEventsForm extends Component
{
    public $timeTrial;

    public $gender_id = '';

    public $showEventsMenu = false;

    public $selectedBoysEvents = [];

    public $selectedGirlsEvents = [];

    public function hideMenu()
    {
        $this->showEventsMenu = false;
        $this->reset(['selectedBoysEvents', 'selectedGirlsEvents']);
    }

    public function showMenu()
    {
        $this->showEventsMenu = true;

        $this->selectedBoysEvents = $this->timeTrial->boysTrackEvents()
            ->where('track_time_trial_id', $this->timeTrial->id)
            ->where('gender_id', 1)
            ->pluck('track_event_id');

        $this->selectedGirlsEvents = $this->timeTrial->girlsTrackEvents()
            ->where('track_time_trial_id', $this->timeTrial->id)
            ->where('gender_id', 2)
            ->pluck('track_event_id');
    }

    public function rules()
    {
        return [
            'selectedBoysEvents' => 'array|numeric',
            'selectedGirlsEvents' => 'array|numeric',
        ];
    }

    public function saveChanges()
    {
        $this->timeTrial->boysTrackEvents()->sync($this->selectedBoysEvents);
        $this->timeTrial->girlsTrackEvents()->sync($this->selectedGirlsEvents);
        $this->hideMenu();
        $this->emit('eventsUpdated');

        session()->flash('success', 'Saved!');
    }

    public function render()
    {
        return view('livewire.time-trials.track-time-trial-events-form', [
            'eventTypes' => TrackEventType::with('subTypes', 'trackEvents')
                ->get(),
        ]);
    }
}
