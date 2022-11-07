<?php

namespace App\Http\Livewire\Main;

use App\Models\Athletes\Athlete;
use Livewire\Component;

class OurTeam extends Component
{
    public function render()
    {
        return view('livewire.main.our-team', [
            'athletes' => Athlete::query()->orderBy('last_name')->get(),
        ]);
    }
}
