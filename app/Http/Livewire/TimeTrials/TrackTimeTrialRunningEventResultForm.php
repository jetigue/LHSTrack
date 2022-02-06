<?php

namespace App\Http\Livewire\TimeTrials;

use App\Models\Athletes\Athlete;
use App\Models\Properties\Events\Track\TrackEvent;
use App\Models\TimeTrials\Results\Track\RunningEventResult;
use Livewire\Component;

class TrackTimeTrialRunningEventResultForm extends Component
{
    public $result = null;
    public $track_event_id;
    public $track_time_trial_id;
    public $gender_id;
    public $athlete_id;
    public $place;
    public $total_seconds;
    public $milliseconds;
    public $heat;
    public $minutes;
    public $seconds;
    public TrackEvent $trackEvent;

    protected $listeners = [
        'cancelCreate' => 'resetForm',
        'submitCreate' => 'submitForm',
        'editResult'
    ];

    public function mount($gender, $timeTrial)
    {
        $this->gender_id = $gender->id;
        $this->track_time_trial_id = $timeTrial->id;
        $this->track_event_id = $this->trackEvent->id;
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function editResult(RunningEventResult $result)
    {
        $this->result = $result;
        $this->athlete_id = $this->result->athlete_id;
        $this->place = $this->result->place;
        $this->total_seconds = $this->result->total_seconds;
        $this->minutes = ~~($this->result->total_seconds % 3600 / 60);
        $this->seconds = ~~($this->result->total_seconds % 60);
        $this->milliseconds = $this->result->milliseconds;
        $this->heat = $this->result->heat;
    }

    public function rules()
    {
        return [
            'athlete_id' => 'required|integer',
            'place' => 'required|integer',
            'minutes' => 'integer|nullable',
            'seconds' => 'required|integer',
            'milliseconds' => 'nullable|integer',
            'heat' => 'required|integer',
        ];
    }

    public function submitForm()
    {
        $this->validate();

        $result = [
            'track_time_trial_id' => $this->track_time_trial_id,
            'track_event_id' => $this->track_event_id,
            'gender_id' => $this->gender_id,
            'athlete_id' => $this->athlete_id,
            'place' => $this->place,
            'total_seconds' => $this->minutes * 60 + $this->seconds,
            'milliseconds' => $this->milliseconds,
            'heat' => $this->heat
        ];

        if ($this->result) {
            RunningEventResult::find($this->result->id)->update($result);
            $this->emit('recordUpdated');
        } else {
            RunningEventResult::create($result);
            $this->emit('recordAdded');
        }
        $this->resetForm();
        $this->emit('hideFormModal');
    }

    public function resetForm()
    {
        $this->reset(['athlete_id', 'gender_id', 'minutes', 'seconds', 'heat', 'milliseconds', 'place']);
    }

    public function render()
    {
        return view('livewire.time-trials.track-time-trial-running-event-result-form', [
            'athletes' => Athlete::where('status', '=', 'a')
                ->orderBy('last_name')
                ->get(),
        ]);
    }
}
