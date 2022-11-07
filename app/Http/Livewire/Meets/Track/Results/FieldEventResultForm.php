<?php

namespace App\Http\Livewire\Meets\Track\Results;

use App\Models\Athletes\Athlete;
use App\Models\Meets\Results\Track\FieldEventResult;
use App\Models\Meets\Results\Track\TeamResult;
use App\Models\Properties\Events\Track\TrackEvent;
use Livewire\Component;
use function view;

class FieldEventResultForm extends Component
{
    public $eventResult = null;

    public $track_event_id;

    public $track_meet_id;

    public $athlete_id;

    public $place;

    public $total_inches;

    public $quarter_inch;

    public $flight;

    public $points;

    public $feet;

    public $inches;

    public $track_team_result_id;

    public TrackEvent $trackEvent;

    public TeamResult $teamResult;

    protected $listeners = [
        'cancelCreate' => 'resetForm',
        'submitCreate' => 'submitForm',
        'editFieldEventResult',
    ];

    public function mount()
    {
        $this->track_team_result_id = $this->teamResult->id;
        $this->track_event_id = $this->trackEvent->id;
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function editFieldEventResult(FieldEventResult $eventResult)
    {
        $this->eventResult = $eventResult;
        $this->athlete_id = $this->eventResult->athlete_id;
        $this->place = $this->eventResult->place;
        $this->total_inches = $this->eventResult->total_inches;
        $this->feet = floor($this->eventResult->total_inches / 12);
        $this->inches = $this->eventResult->total_inches % 12;
        $this->quarter_inch = $this->eventResult->quarter_inch;
        $this->flight = $this->eventResult->flight;
        $this->points = $this->eventResult->points;
    }

    public function rules()
    {
        return [
            'athlete_id' => 'required|integer',
            'place' => 'required|integer|min:1',
            'feet' => 'integer|required|min:1',
            'inches' => 'nullable|integer|max:11',
            'quarter_inch' => 'nullable|integer|min:0|max:3',
            'flight' => 'nullable|integer',
            'points' => 'nullable|integer|min:0',
        ];
    }

    public function submitForm()
    {
        $this->validate();

        $eventResult = [
            'track_team_result_id' => $this->track_team_result_id,
            'track_event_id' => $this->track_event_id,
            'athlete_id' => $this->athlete_id,
            'place' => $this->place,
            'total_inches' => ($this->feet * 12) + $this->inches,
            'quarter_inch' => $this->quarter_inch,
            'flight' => $this->flight,
            'points' => $this->points,
        ];

        if ($this->eventResult) {
            FieldEventResult::find($this->eventResult->id)->update($eventResult);
            $this->emit('recordUpdated');
        } else {
            FieldEventResult::create($eventResult);
            $this->emit('recordAdded');
        }
        $this->resetForm();
        $this->emit('hideFormModal');
    }

    public function resetForm()
    {
        $this->reset(['athlete_id', 'feet', 'inches', 'quarter_inch', 'flight', 'place', 'points']);
    }

    public function render()
    {
        return view('livewire.meets.track.results.field-event-result-form', [
            'athletes' => Athlete::where('status', '=', 'a')
                ->orderBy('last_name')
                ->get(),
        ]);
    }
}
