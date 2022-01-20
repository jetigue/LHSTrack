<?php

namespace App\Http\Livewire\TimeTrials;

use App\Models\Properties\Events\Category;
use App\Models\Properties\Events\TrackEvent;
use App\Models\TimeTrials\TrackTimeTrial;
use Livewire\Component;

class ShowTrackTimeTrial extends Component
{
    public TrackTimeTrial $timeTrial;

    public function render()
    {
        return view('livewire.time-trials.show-track-time-trial', [
//            'trackEvents' => TrackEvent::with('timeTrials', 'category')
//                ->where()
        ]);
    }
}
