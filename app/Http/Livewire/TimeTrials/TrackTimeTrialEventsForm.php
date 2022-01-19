<?php

namespace App\Http\Livewire\TimeTrials;

use App\Models\Properties\Events\Category;
use App\Models\Properties\Events\TrackEvent;
use Livewire\Component;

class TrackTimeTrialEventsForm extends Component
{

    public function render()
    {
        return view('livewire.time-trials.track-time-trial-events-form', [
            'eventCategories' => Category::orderBy('name')->get()
        ]);
    }
}
