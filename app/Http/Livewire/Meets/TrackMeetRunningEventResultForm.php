<?php

namespace App\Http\Livewire\Meets;

use App\Models\Athletes\Athlete;
use App\Models\Meets\Results\Track\RunningEventResult;
use App\Models\Properties\Events\Track\TrackEvent;
use Livewire\Component;

class TrackMeetRunningEventResultForm extends Component
{
    public $eventResult = null;
    public $track_event_id;
    public $track_meet_id;
    public $gender_id;
    public $athlete_id;
    public $place;
    public $total_seconds;
    public $milliseconds;
    public $heat;
    public $points;
    public $minutes;
    public $seconds;
    public TrackEvent $trackEvent;

    protected $listeners = [
        'cancelCreate' => 'resetForm',
        'submitCreate' => 'submitForm',
        'editRunningEventResult'
    ];

    public function mount($gender, $trackMeet)
    {
        $this->gender_id = $gender->id;
        $this->track_meet_id = $trackMeet->id;
        $this->track_event_id = $this->trackEvent->id;
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function editRunningEventResult(RunningEventResult $eventResult)
    {
        $this->eventResult = $eventResult;
        $this->athlete_id = $this->eventResult->athlete_id;
        $this->place = $this->eventResult->place;
        $this->total_seconds = $this->eventResult->total_seconds;
        $this->minutes = ~~($this->eventResult->total_seconds % 3600 / 60);
        $this->seconds = ~~($this->eventResult->total_seconds % 60);
        $this->milliseconds = $this->eventResult->milliseconds;
        $this->heat = $this->eventResult->heat;
        $this->points = $this->eventResult->points;
        $this->gender_id = $this->eventResult->gender_id;
    }

    public function rules()
    {
        return [
            'athlete_id' => 'required|integer',
            'place' => 'required|integer|min:1',
            'minutes' => 'integer|nullable',
            'seconds' => 'required|integer',
            'milliseconds' => 'nullable|integer',
            'heat' => 'nullable|integer',
            'points' => 'nullable|integer|min:0'
        ];
    }

    public function submitForm()
    {
        $this->validate();

        $eventResult = [
            'track_meet_id' => $this->track_meet_id,
            'track_event_id' => $this->track_event_id,
            'gender_id' => $this->gender_id,
            'athlete_id' => $this->athlete_id,
            'place' => $this->place,
            'total_seconds' => $this->minutes * 60 + $this->seconds,
            'milliseconds' => $this->milliseconds,
            'heat' => $this->heat,
            'points' => $this->points
        ];

        if ($this->eventResult) {
            RunningEventResult::find($this->eventResult->id)->update($eventResult);
            $this->emit('recordUpdated');
        } else {
            RunningEventResult::create($eventResult);
            $this->emit('recordAdded');
        }
        $this->resetForm();
        $this->emit('hideFormModal');
    }

    public function resetForm()
    {
        $this->reset(['athlete_id', 'minutes', 'seconds', 'heat', 'milliseconds', 'place', 'points']);
    }

    public function render()
    {
        return view('livewire.meets.track-meet-running-event-result-form', [
            'athletes' => Athlete::where('status', '=', 'a')
                ->orderBy('last_name')
                ->get(),
        ]);
    }
}
