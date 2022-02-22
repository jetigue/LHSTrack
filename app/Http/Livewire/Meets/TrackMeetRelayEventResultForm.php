<?php

namespace App\Http\Livewire\Meets;

use App\Models\Athletes\Athlete;
use App\Models\Meets\Results\Track\RelayEventResult;
use App\Models\Meets\Results\Track\RunningEventResult;
use App\Models\Properties\Events\Track\TrackEvent;
use Livewire\Component;

class TrackMeetRelayEventResultForm extends Component
{
    public $relayEventResult = null;
    public $track_event_id;
    public $track_meet_id;
    public $gender_id;
    public $leg_1_athlete_id;
    public $leg_2_athlete_id;
    public $leg_3_athlete_id;
    public $leg_4_athlete_id;
    public $place;
    public $total_seconds;
    public $milliseconds;
    public $leg_1_total_seconds;
    public $leg_1_milliseconds;
    public $leg_2_total_seconds;
    public $leg_2_milliseconds;
    public $leg_3_total_seconds;
    public $leg_3_milliseconds;
    public $leg_4_total_seconds;
    public $leg_4_milliseconds;
    public $heat;
    public $points;
    public $minutes;
    public $seconds;
    public $leg_1_minutes;
    public $leg_1_seconds;
    public $leg_2_minutes;
    public $leg_2_seconds;
    public $leg_3_minutes;
    public $leg_3_seconds;
    public $leg_4_minutes;
    public $leg_4_seconds;
    public $relay_team;
    public TrackEvent $trackEvent;

    protected $listeners = [
        'cancelCreate' => 'resetForm',
        'submitCreate' => 'submitForm',
        'editRelayEventResult'
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

    public function editRelayEventResult(RelayEventResult $relayEventResult)
    {
        $this->relayEventResult = $relayEventResult;
        $this->relay_team = $this->relayEventResult->relay_team;
        $this->leg_1_athlete_id = $this->relayEventResult->leg_1_athlete_id;
        $this->leg_2_athlete_id = $this->relayEventResult->leg_2_athlete_id;
        $this->leg_3_athlete_id = $this->relayEventResult->leg_3_athlete_id;
        $this->leg_4_athlete_id = $this->relayEventResult->leg_4_athlete_id;
        $this->place = $this->relayEventResult->place;
        $this->total_seconds = $this->relayEventResult->total_seconds;
        $this->minutes = ~~($this->relayEventResult->total_seconds % 3600 / 60);
        $this->seconds = ~~($this->relayEventResult->total_seconds % 60);
        $this->milliseconds = $this->relayEventResult->milliseconds;
        $this->leg_1_total_seconds = $this->relayEventResult->leg_1_total_seconds;
        $this->leg_1_minutes = ~~($this->relayEventResult->leg_1_total_seconds % 3600 / 60);
        $this->leg_1_seconds = ~~($this->relayEventResult->leg_1_total_seconds % 60);
        $this->leg_1_milliseconds = $this->relayEventResult->leg_1_milliseconds;
        $this->leg_2_total_seconds = $this->relayEventResult->leg_2_total_seconds;
        $this->leg_2_minutes = ~~($this->relayEventResult->leg_2_total_seconds % 3600 / 60);
        $this->leg_2_seconds = ~~($this->relayEventResult->leg_2_total_seconds % 60);
        $this->leg_2_milliseconds = $this->relayEventResult->leg_2_milliseconds;
        $this->leg_3_total_seconds = $this->relayEventResult->leg_3_total_seconds;
        $this->leg_3_minutes = ~~($this->relayEventResult->leg_3_total_seconds % 3600 / 60);
        $this->leg_3_seconds = ~~($this->relayEventResult->leg_3_total_seconds % 60);
        $this->leg_3_milliseconds = $this->relayEventResult->leg_3_milliseconds;
        $this->leg_4_total_seconds = $this->relayEventResult->leg_4_total_seconds;
        $this->leg_4_minutes = ~~($this->relayEventResult->leg_4_total_seconds % 3600 / 60);
        $this->leg_4_seconds = ~~($this->relayEventResult->leg_4_total_seconds % 60);
        $this->leg_4_milliseconds = $this->relayEventResult->leg_4_milliseconds;
        $this->heat = $this->relayEventResult->heat;
        $this->points = $this->relayEventResult->points;
        $this->gender_id = $this->relayEventResult->gender_id;
    }

    public function rules()
    {
        return [
            'heat' => 'nullable|integer',
            'leg_1_athlete_id' => 'required|integer',
            'leg_1_milliseconds' => 'nullable|integer',
            'leg_1_minutes' => 'integer|nullable',
            'leg_1_seconds' => 'required|integer',
            'leg_2_athlete_id' => 'required|integer',
            'leg_2_milliseconds' => 'nullable|integer',
            'leg_2_minutes' => 'integer|nullable',
            'leg_2_seconds' => 'required|integer',
            'leg_3_athlete_id' => 'required|integer',
            'leg_3_milliseconds' => 'nullable|integer',
            'leg_3_minutes' => 'integer|nullable',
            'leg_3_seconds' => 'required|integer',
            'leg_4_athlete_id' => 'required|integer',
            'leg_4_milliseconds' => 'nullable|integer',
            'leg_4_minutes' => 'integer|nullable',
            'leg_4_seconds' => 'required|integer',
            'milliseconds' => 'nullable|integer',
            'minutes' => 'integer|nullable',
            'place' => 'required|integer|min:1',
            'points' => 'nullable|integer|min:0',
            'relay_team' => 'required|string|max:1',
            'seconds' => 'required|integer',
        ];
    }

    public function submitForm()
    {
        $this->validate();

        $relayEventResult = [
            'track_meet_id' => $this->track_meet_id,
            'track_event_id' => $this->track_event_id,
            'gender_id' => $this->gender_id,
            'leg_1_athlete_id' => $this->leg_1_athlete_id,
            'leg_2_athlete_id' => $this->leg_2_athlete_id,
            'leg_3_athlete_id' => $this->leg_3_athlete_id,
            'leg_4_athlete_id' => $this->leg_4_athlete_id,
            'place' => $this->place,
            'total_seconds' => $this->minutes * 60 + $this->seconds,
            'milliseconds' => $this->milliseconds,
            'leg_1_total_seconds' => $this->leg_1_minutes * 60 + $this->leg_1_seconds,
            'leg_1_milliseconds' => $this->leg_1_milliseconds,
            'leg_2_total_seconds' => $this->leg_2_minutes * 60 + $this->leg_2_seconds,
            'leg_2_milliseconds' => $this->leg_2_milliseconds,
            'leg_3_total_seconds' => $this->leg_3_minutes * 60 + $this->leg_3_seconds,
            'leg_3_milliseconds' => $this->leg_3_milliseconds,
            'leg_4_total_seconds' => $this->leg_4_minutes * 60 + $this->leg_4_seconds,
            'leg_4_milliseconds' => $this->leg_4_milliseconds,
            'heat' => $this->heat,
            'relay_team' => $this->relay_team,
            'points' => $this->points
        ];

        if ($this->relayEventResult) {
            RelayEventResult::find($this->relayEventResult->id)->update($relayEventResult);
            $this->emit('recordUpdated');
        } else {
            RelayEventResult::create($relayEventResult);
            $this->emit('recordAdded');
        }
        $this->resetForm();
        $this->emit('hideFormModal');
    }

    public function resetForm()
    {
        $this->reset([
            'leg_1_athlete_id',
            'leg_2_athlete_id',
            'leg_3_athlete_id',
            'leg_4_athlete_id',
            'minutes',
            'seconds',
            'milliseconds',
            'leg_1_minutes',
            'leg_1_seconds',
            'leg_1_milliseconds',
            'leg_2_minutes',
            'leg_2_seconds',
            'leg_2_milliseconds',
            'leg_3_minutes',
            'leg_3_seconds',
            'leg_3_milliseconds',
            'leg_4_minutes',
            'leg_4_seconds',
            'leg_4_milliseconds',
            'place',
            'points',
            'heat',
            'relay_team'
        ]);
    }

    public function render()
    {
        return view('livewire.meets.track-meet-relay-event-result-form', [
            'athletes' => Athlete::where('status', '=', 'a')
                ->orderBy('last_name')
                ->get(),
        ]);
    }
}
