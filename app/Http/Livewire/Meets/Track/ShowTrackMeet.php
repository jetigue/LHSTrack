<?php

namespace App\Http\Livewire\Meets\Track;

use App\Models\Meets\TrackMeet;
use Livewire\Component;
use function view;

class ShowTrackMeet extends Component
{
    public TrackMeet $trackMeet;

    public function render()
    {
        return view('livewire.meets.show-track-meet');
    }
}
