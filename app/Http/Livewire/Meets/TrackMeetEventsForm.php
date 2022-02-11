<?php

namespace App\Http\Livewire\Meets;

use App\Models\Meets\TrackMeet;
use App\Models\Properties\Events\Track\TrackEventType;
use Livewire\Component;
use function view;

class TrackMeetEventsForm extends Component
{
    public $trackMeet;
    public $gender_id = '';
    public $showEventsMenu = false;
    public $selectedBoysEvents = [];
    public $selectedGirlsEvents = [];

    public function hideMenu()
    {
        $this->showEventsMenu = false;
        $this->reset(['selectedBoysEvents', 'selectedGirlsEvents']);
    }

    public function showMenu()
    {
        $this->showEventsMenu = true;

        $this->selectedBoysEvents = $this->trackMeet->boysTrackEvents()
            ->where('track_meet_id', $this->trackMeet->id)
            ->where('gender_id', 1)
            ->pluck('track_event_id');

        $this->selectedGirlsEvents = $this->trackMeet->girlsTrackEvents()
            ->where('track_meet_id', $this->trackMeet->id)
            ->where('gender_id', 2)
            ->pluck('track_event_id');
    }

    public function rules()
    {
        return [
            'selectedBoysEvents' => 'array|numeric',
            'selectedGirlsEvents' => 'array|numeric',
        ];
    }

public function saveChanges()
{
    $this->trackMeet->boysTrackEvents()->sync($this->selectedBoysEvents);
    $this->trackMeet->girlsTrackEvents()->sync($this->selectedGirlsEvents);
    $this->hideMenu();
    $this->emit('eventsUpdated');

    session()->flash('success', 'Saved!');
}

    public function render()
    {
        return view('livewire.meets.track-meet-events-form', [
            'eventTypes' => TrackEventType::with('subTypes', 'trackEvents')
                ->get(),
        ]);
    }
}
