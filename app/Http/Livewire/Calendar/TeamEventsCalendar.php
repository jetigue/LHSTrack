<?php

namespace App\Http\Livewire\Calendar;

use App\Models\Communication\TeamEvent;
use Asantibanez\LivewireCalendar\LivewireCalendar;
use Illuminate\Support\Collection;

//use Illuminate\Database\Eloquent\Collection;

class TeamEventsCalendar extends LivewireCalendar
{
    public function events(): Collection
    {
        return TeamEvent::query()
            ->whereDate('event_date', '>=', $this->gridStartsAt)
            ->whereDate('event_date', '<=', $this->gridEndsAt)
            ->get()
            ->map(function (TeamEvent $teamEvent) {
                return [
                    'id' => $teamEvent->id,
                    'title' => $teamEvent->title,
                    'description' => $teamEvent->description,
                    'date' => $teamEvent->event_date,
                ];
            });
    }

//        public function onDayClick($year, $month, $day)
//        {
//            // This event is triggered when a day is clicked
//            // You will be given the $year, $month and $day for that day
//        }

        public function onEventClick($eventId)
        {
            $this->emit('showEventModal', $eventId);
        }

        public function onEventDropped($eventId, $year, $month, $day)
        {
            TeamEvent::where('id', $eventId)->update(['event_date' => $year . '-' . $month . '-' . $day]);
        }
}
