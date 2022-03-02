<?php

namespace App\Http\Livewire\Meets\Track\Results;

use App\Models\Properties\Events\Track\TrackEventType;
use Livewire\Component;
use function session;
use function view;

class TeamResultEventsForm extends Component
{
    public $teamResult;
    public $gender_id = '';
    public $showEventsMenu = false;
    public $selectedEvents = [];
//    public $selectedBoysEvents = [];
//    public $selectedGirlsEvents = [];

    public function hideMenu()
    {
        $this->showEventsMenu = false;
        $this->reset(['selectedEvents', 'selectedEvents']);
//        $this->reset(['selectedBoysEvents', 'selectedGirlsEvents']);
    }

    public function showMenu()
    {
        $this->showEventsMenu = true;

        $this->selectedEvents = $this->teamResult->trackEvents()
            ->where('track_team_result_id', $this->teamResult->id)
            ->pluck('track_event_id');

//        $this->selectedBoysEvents = $this->trackMeet->boysTrackEvents()
//            ->where('track_meet_id', $this->trackMeet->id)
//            ->where('gender_id', 1)
//            ->pluck('track_event_id');
//
//        $this->selectedGirlsEvents = $this->trackMeet->girlsTrackEvents()
//            ->where('track_meet_id', $this->trackMeet->id)
//            ->where('gender_id', 2)
//            ->pluck('track_event_id');
    }

    public function rules()
    {
        return [
            'selectedEvents' => 'array|numeric',
//            'selectedBoysEvents' => 'array|numeric',
//            'selectedGirlsEvents' => 'array|numeric',
        ];
    }

public function saveChanges()
{
    $this->teamResult->trackEvents()->sync($this->selectedEvents);
//    $this->trackMeet->boysTrackEvents()->sync($this->selectedBoysEvents);
//    $this->trackMeet->girlsTrackEvents()->sync($this->selectedGirlsEvents);
    $this->hideMenu();
    $this->emit('eventsUpdated');

    session()->flash('success', 'Saved!');
}

    public function render()
    {
        return view('livewire.meets.track.results.team-results-events-form', [
            'eventTypes' => TrackEventType::with('subTypes', 'trackEvents')
                ->get(),
        ]);
    }
}
