<?php

namespace App\Http\Livewire\TimeTrials;

use App\Models\Properties\Meets\Timing;
use App\Models\Properties\Meets\Track\Venue;
use App\Models\TimeTrials\TrackTimeTrial;
use Livewire\Component;

class TrackTimeTrialForm extends Component
{
    public $trackTimeTrial = null;
    public $name;
    public $trial_date_for_editing;
    public $timing_method_id;
    public $track_venue_id;

    protected $listeners = [
        'cancelCreate' => 'resetForm',
        'submitCreate' => 'submitForm',
        'editTrackTimeTrial'
    ];

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function editTrackTimeTrial(TrackTimeTrial $timeTrial)
    {
        $this->trackTimeTrial = $timeTrial;
        $this->name = $this->trackTimeTrial->name;
        $this->trial_date_for_editing = $this->trackTimeTrial->trial_date_for_editing;
        $this->timing_method_id = $this->trackTimeTrial->timing_method_id;
        $this->track_venue_id = $this->trackTimeTrial->track_venue_id;
    }

    public function rules()
    {
        return [
            'name' => 'required|string',
            'trial_date_for_editing' => 'required|date',
            'timing_method_id' => 'required|integer',
            'track_venue_id' => 'required|integer'
        ];
    }

    public function submitForm()
    {
        $this->validate();

        $timeTrial = [
            'name' => $this->name,
            'trial_date' => $this->trial_date_for_editing,
            'timing_method_id' => $this->timing_method_id,
            'track_venue_id' => $this->track_venue_id,
        ];

        if ($this->trackTimeTrial) {
            TrackTimeTrial::find($this->trackTimeTrial->id)->update($timeTrial);
            $this->emit('recordUpdated');
        } else {
            TrackTimeTrial::create($timeTrial);
            $this->emit('recordAdded');
        }
        $this->resetForm();
        $this->emit('hideFormModal');
    }

    public function resetForm()
    {
        $this->reset([
            'name',
            'trial_date_for_editing',
            'timing_method_id',
            'track_venue_id',
        ]);
    }

    public function render()
    {
        return view('livewire.time-trials.track-time-trial-form', [
            'trackVenues' => Venue::orderBy('name')->get(),
            'timingMethods' => Timing::orderBy('name')->get(),
        ]);
    }
}
