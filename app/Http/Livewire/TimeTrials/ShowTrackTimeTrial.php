<?php

namespace App\Http\Livewire\TimeTrials;

use App\Models\Properties\Events\EventCategory;
use App\Models\Properties\Events\TrackEvent;
use App\Models\TimeTrials\TrackTimeTrial;
use Livewire\Component;

class ShowTrackTimeTrial extends Component
{
    public TrackTimeTrial $timeTrial;
    public bool $addOrEditEvents = false;
    public $selected = [];

    public function rules()
    {
        return [
            'selected' => 'array|numeric',
        ];
    }

    public function showEventsForm()
    {
        $this->addOrEditEvents = true;

        $this->selected = $this->timeTrial->trackEvents()
            ->where('track_time_trial_id', $this->timeTrial->id)
            ->pluck('id');
    }

    public function hideEventsForm()
    {
        $this->addOrEditEvents = false;
        $this->reset(['selected']);
    }

    public function saveChanges()
    {
        $this->timeTrial->trackEvents()->sync($this->selected);
        $this->hideEventsForm();
    }

    public function render()
    {
        return view('livewire.time-trials.show-track-time-trial', [
            'eventCategories' => EventCategory::with('trackEvents')
                ->get(),
            'trackEvents' => TrackEvent::all()
        ]);
    }
}
