<?php

namespace App\Http\Livewire\Main;

use App\Models\Communication\TeamAnnouncement;
use Carbon\Carbon;
use Livewire\Component;

class WelcomePageAnnouncements extends Component
{
    public TeamAnnouncement $announcement;

    public function displayAnnouncement(TeamAnnouncement $announcement): TeamAnnouncement
    {
        return $this->displayedAnnouncement = $announcement;
    }

    public function render()
    {
        return view('livewire.main.welcome-page-announcements', [
            'announcements' => TeamAnnouncement::with('owner')
                ->whereDate('end_date', '>=', Carbon::today())
                ->orderBy('updated_at', 'desc')->get(),

            'displayedAnnouncement' => TeamAnnouncement::with('owner')
                ->whereDate('end_date', '>=', Carbon::today())
                ->orderBy('updated_at', 'desc')->first(),
        ]);
    }
}
