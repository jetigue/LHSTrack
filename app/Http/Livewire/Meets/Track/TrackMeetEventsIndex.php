<?php

namespace App\Http\Livewire\Meets\Track;

use App\Models\Meets\Results\Track\TeamResult;
use Livewire\Component;

class TrackMeetEventsIndex extends Component
{
    public TeamResult $teamResult;
    public $editing = false;
    public $showFormModal = false;

    protected $listeners = [
        'eventsUpdated' => '$refresh'
    ];

    public function addResults()
    {
        $this->showFormModal = true;
    }

    public function cancel()
    {
        $this->showFormModal = false;
        $this->editing = false;
    }

    public function render()
    {
        return view('livewire.meets.track.track-meet-events-index', [

            'trackEvents' => $this->teamResult->trackEvents
                ->sortBy('name')
                ->sortBy('distance_in_meters'),
        ]);
    }
}
