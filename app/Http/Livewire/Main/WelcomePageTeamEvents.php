<?php

namespace App\Http\Livewire\Main;

use App\Models\Communication\TeamEvent;
use Carbon\Carbon;
use Livewire\Component;

class WelcomePageTeamEvents extends Component
{
    public function render()
    {
        return view('livewire.main.welcome-page-team-events', [
            'events' => TeamEvent::with('owner')
                ->whereDate('event_date', '>=', Carbon::today())
                ->orderBy('event_date')->get(),
        ]);
    }
}
