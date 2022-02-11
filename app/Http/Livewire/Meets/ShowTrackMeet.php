<?php

namespace App\Http\Livewire\Meets;

use App\Models\Meets\TrackMeet;
use Livewire\Component;

class ShowTrackMeet extends Component
{
    public TrackMeet $trackMeet;

    public function render()
    {
        return view('livewire.meets.show-track-meet');
    }
}
