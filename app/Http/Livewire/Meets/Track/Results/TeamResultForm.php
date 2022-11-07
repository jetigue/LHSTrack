<?php

namespace App\Http\Livewire\Meets\Track\Results;

use App\Models\Meets\Results\Track\TeamResult;
use App\Models\Meets\TrackMeet;
use App\Models\Properties\Races\Division;
use Livewire\Component;

class TeamResultForm extends Component
{
    public $division_id;

    public $notes;

    public $number_teams;

    public $place;

    public $points;

    public $teamResult = null;

    public TrackMeet $trackMeet;

    protected $listeners = [
        'cancelCreate' => 'resetForm',
        'submitCreate' => 'submitForm',
        'editTeamResult',
    ];

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function editTeamResult(TeamResult $teamResult)
    {
        $this->teamResult = $teamResult;
        $this->division_id = $this->teamResult->division_id;
        $this->place = $this->teamResult->place;
        $this->points = $this->teamResult->points;
        $this->number_teams = $this->teamResult->number_teams;
        $this->notes = $this->teamResult->notes;
    }

    public function rules()
    {
        return [
            'division_id' => 'required|integer',
            'place' => 'integer|nullable',
            'points' => 'integer|nullable',
            'number_teams' => 'required|integer',
            'notes' => 'string|nullable',
        ];
    }

    public function submitForm()
    {
        $this->validate();

        $teamResult = [
            'track_meet_id' => $this->trackMeet->id,
            'division_id' => $this->division_id,
            'place' => $this->place,
            'points' => $this->points,
            'number_teams' => $this->number_teams,
            'notes' => $this->notes,
        ];

        if ($this->teamResult) {
            TeamResult::find($this->teamResult->id)->update($teamResult);
            $this->emit('recordUpdated');
        } else {
            TeamResult::create($teamResult);
            $this->emit('recordAdded');
        }
        $this->resetForm();
        $this->emit('hideFormModal');
    }

    public function resetForm()
    {
        $this->reset([
            'division_id',
            'place',
            'points',
            'number_teams',
            'notes',
        ]);
    }

    public function render()
    {
        return view('livewire.meets.track.results.team-result-form', [
            'divisions' => Division::all(),
        ]);
    }
}
