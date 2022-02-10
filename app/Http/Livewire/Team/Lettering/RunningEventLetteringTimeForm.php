<?php

namespace App\Http\Livewire\Team\Lettering;

use App\Models\Properties\Events\Track\TrackEvent;
use App\Models\Team\RunningEventLetteringTime;
use Livewire\Component;

class RunningEventLetteringTimeForm extends Component
{
    public $letteringTime = null;
    public $track_event_id;

    public $freshman_total_seconds;
    public $freshman_milliseconds;
    public $sophomore_total_seconds;
    public $sophomore_milliseconds;
    public $junior_total_seconds;
    public $junior_milliseconds;
    public $senior_total_seconds;
    public $senior_milliseconds;
    public $freshman_minutes;
    public $freshman_seconds;
    public $sophomore_minutes;
    public $sophomore_seconds;
    public $junior_minutes;
    public $junior_seconds;
    public $senior_minutes;
    public $senior_seconds;
    public $gender_id;

    protected $listeners = [
        'cancelCreate' => 'resetForm',
        'submitCreate' => 'submitForm',
        'editRunningStandard'
    ];

    public function mount($gender)
    {
        return $this->gender_id = $gender->id;
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function editRunningStandard(RunningEventLetteringTime $letteringTime)
    {
        $this->letteringTime = $letteringTime;
        $this->track_event_id = $this->letteringTime->track_event_id;
        $this->freshman_total_seconds = $this->letteringTime->freshman_total_seconds;
        $this->freshman_minutes = ~~($this->letteringTime->freshman_total_seconds % 3600 / 60);
        $this->freshman_seconds = ~~($this->letteringTime->freshman_total_seconds % 60);
        $this->freshman_milliseconds = $this->letteringTime->freshman_milliseconds;
        $this->sophomore_total_seconds = $this->letteringTime->sophomore_total_seconds;
        $this->sophomore_minutes = ~~($this->letteringTime->sophomore_total_seconds % 3600 / 60);
        $this->sophomore_seconds = ~~($this->letteringTime->sophomore_total_seconds % 60);
        $this->sophomore_milliseconds = $this->letteringTime->sophomore_milliseconds;
        $this->junior_total_seconds = $this->letteringTime->junior_total_seconds;
        $this->junior_minutes = ~~($this->letteringTime->junior_total_seconds % 3600 / 60);
        $this->junior_seconds = ~~($this->letteringTime->junior_total_seconds % 60);
        $this->junior_milliseconds = $this->letteringTime->junior_milliseconds;
        $this->senior_total_seconds = $this->letteringTime->senior_total_seconds;
        $this->senior_minutes = ~~($this->letteringTime->senior_total_seconds % 3600 / 60);
        $this->senior_seconds = ~~($this->letteringTime->senior_total_seconds % 60);
        $this->senior_milliseconds = $this->letteringTime->senior_milliseconds;
        $this->gender_id = $this->letteringTime->gender_id;
    }

    public function rules()
    {
        return [
            'track_event_id' => 'required|integer',
            'freshman_minutes' => 'integer|nullable',
            'freshman_seconds' => 'required|integer',
            'freshman_milliseconds' => 'nullable|integer',
            'sophomore_minutes' => 'integer|nullable',
            'sophomore_seconds' => 'required|integer',
            'sophomore_milliseconds' => 'nullable|integer',
            'junior_minutes' => 'integer|nullable',
            'junior_seconds' => 'required|integer',
            'junior_milliseconds' => 'nullable|integer',
            'senior_minutes' => 'integer|nullable',
            'senior_seconds' => 'required|integer',
            'senior_milliseconds' => 'nullable|integer',
        ];
    }

    public function submitForm()
    {
        $this->validate();

        $letteringTime = [
            'track_event_id' => $this->track_event_id,
            'gender_id' => $this->gender_id,
            'freshman_total_seconds' => ($this->freshman_minutes * 60) + $this->freshman_seconds,
            'freshman_milliseconds' => $this->freshman_milliseconds,
            'sophomore_total_seconds' => ($this->sophomore_minutes * 60) + $this->sophomore_seconds,
            'sophomore_milliseconds' => $this->sophomore_milliseconds,
            'junior_total_seconds' => ($this->junior_minutes * 60) + $this->junior_seconds,
            'junior_milliseconds' => $this->junior_milliseconds,
            'senior_total_seconds' => ($this->senior_minutes * 60) + $this->senior_seconds,
            'senior_milliseconds' => $this->senior_milliseconds,
        ];

        if ($this->letteringTime) {
            RunningEventLetteringTime::find($this->letteringTime->id)->update($letteringTime);
            $this->emit('recordUpdated');
        } else {
            RunningEventLetteringTime::create($letteringTime);
            $this->emit('recordAdded');
        }
        $this->resetForm();
        $this->emit('hideFormModal');
    }

    public function resetForm()
    {
        $this->reset([
            'track_event_id',
            'freshman_minutes',
            'freshman_seconds',
            'freshman_milliseconds',
            'sophomore_minutes',
            'sophomore_seconds',
            'sophomore_milliseconds',
            'junior_minutes',
            'junior_seconds',
            'junior_milliseconds',
            'senior_minutes',
            'senior_seconds',
            'senior_milliseconds',
        ]);
    }

    public function render()
    {
        return view('livewire.team.lettering.running-event-lettering-time-form', [
            'trackEvents' => TrackEvent::where('distance_in_meters', '>', 0)->orderBy('distance_in_meters')->get()
        ]);
    }
}
