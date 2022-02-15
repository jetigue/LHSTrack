<?php

namespace App\Http\Livewire\Training;

use App\Models\Athletes\Athlete;
use Livewire\Component;

class DistanceTrainingPacesIndex extends Component
{
    public function render()
    {
        return view('livewire.training.distance-training-paces-index', [
            'athletes' => Athlete::all()
        ]);
    }
}
