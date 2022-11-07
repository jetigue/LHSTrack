<?php

namespace App\Http\Livewire\Calendar;

use App\Models\Communication\TeamEvent;
use Livewire\Component;

class MonthlyCalendar extends Component
{
    public $teamEvent;

    public bool $showEventModal = false;

    protected $listeners = ['showEventModal' => 'showModal'];

    public function showModal($teamEventId)
    {
        $this->teamEvent = TeamEvent::firstWhere('id', $teamEventId);

        $this->showEventModal = true;
    }

    public function showMobileModal(TeamEvent $teamEvent)
    {
        $this->teamEvent = $teamEvent;

        $this->showEventModal = true;
    }

    public function hideModal()
    {
        $this->showEventModal = false;
    }

    public function render()
    {
        return view('livewire.calendar.monthly-calendar', [
            'events' => TeamEvent::query()
                ->orderBy('event_date')
                ->get(),
        ]);
    }
}
