<?php

namespace App\Http\Livewire\Team\Lettering;

use App\Models\Properties\Races\Gender;
use App\Models\Team\RunningEventLetteringTime;
use Livewire\Component;

class TeamLetteringStandards extends Component
{
    public function render()
    {
        return view('livewire.team.lettering.team-lettering-standards', [
            'genders' => Gender::all()->take(2)
        ]);
    }
}
