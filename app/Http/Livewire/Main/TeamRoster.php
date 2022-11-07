<?php

namespace App\Http\Livewire\Main;

use App\Models\Athletes\Athlete;
use Carbon\Carbon;
use Livewire\Component;

class TeamRoster extends Component
{
    public $nextSeason;

    public $currentYear;

    public function mount()
    {
        $this->nextSeason = Carbon::now()->month >= 6 ? 1 : 0;
        $this->currentYear = Carbon::now()->year;
    }

    public function render()
    {
        return view('livewire.main.team-roster', [
            'athletes' => Athlete::where('status', '!=', 'i')
                ->orderBy('last_name')
                ->orderBy('first_name')
                ->get(),
        ]);
    }
}
