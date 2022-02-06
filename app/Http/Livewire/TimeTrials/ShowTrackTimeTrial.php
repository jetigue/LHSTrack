<?php

namespace App\Http\Livewire\TimeTrials;

use App\Models\TimeTrials\TrackTimeTrial;
use Livewire\Component;

class ShowTrackTimeTrial extends Component
{
    public TrackTimeTrial $timeTrial;
    public $addOrEditBoysEvents = false;
    public $addOrEditGirlsEvents = false;
    public $isDisabledBoys = false;
    public $isDisabledGirls = false;
    public $selectedBoysEvents = [];
    public $selectedGirlsEvents = [];
    public $selected = [];

    public function rules()
    {
        return [
            'selected' => 'array|numeric',
        ];
    }

    public function showBoysEventsForm()
    {
        $this->addOrEditBoysEvents = true;
        $this->isDisabledGirls = true;

        $this->selected = $this->timeTrial->boysTrackEvents()
            ->where('track_time_trial_id', $this->timeTrial->id)
            ->pluck('id');
    }

    public function showGirlsEventsForm()
    {
        $this->addOrEditGirlsEvents = true;
        $this->isDisabledBoys = true;

        $this->selected = $this->timeTrial->girlsTrackEvents()
            ->where('track_time_trial_id', $this->timeTrial->id)
            ->pluck('id');
    }

    public function hideBoysEventsForm()
    {
        $this->addOrEditBoysEvents = false;
        $this->reset(['selectedBoysEvents']);
    }

    public function hideGirlsEventsForm()
    {
        $this->addOrEditGirlsEvents = false;
        $this->reset(['selectedGirlsEvents']);
    }

    public function saveBoysEventChanges()
    {
        $this->selectedBoysEvents = $this->selected;
        $this->timeTrial->boysTrackEvents()->sync($this->selected);
    }

    public function saveGirlsEventChanges()
    {
        $this->selectedGirlsEvents = $this->selected;
        $this->timeTrial->girlsTrackEvents()->sync($this->selected);
        $this->hideGirlsEventsForm();
    }

    public function render()
    {
        return view('livewire.time-trials.show-track-time-trial', [
        ]);
    }
}
