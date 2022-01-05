<?php

namespace App\Http\Livewire\Athletes;

use App\Models\Athletes\Athlete;
use Livewire\Component;

class AthleteProfile extends Component
{
    public Athlete $athlete;

    public function render()
    {
        return view('livewire.athletes.athlete-profile');
    }
}
