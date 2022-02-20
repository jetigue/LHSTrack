<?php

namespace App\Http\Livewire\Training\EventPages;

use App\Models\Properties\Events\Track\TrackEventSubtype;
use App\Models\Training\Workouts\EventSubtypeWorkout;
use App\Models\Training\Workouts\HurdleWorkout;
use Asantibanez\LivewireCalendar\LivewireCalendar;
use Illuminate\Support\Collection;

class EventSubtypeWorkoutCalendar extends LivewireCalendar
{
    public TrackEventSubtype $eventSubtype;

    public function events(): Collection
        {
            return EventSubtypeWorkout ::query()
                ->where('track_event_subtype_id', $this->eventSubtype->id)
                ->whereDate('workout_date', '>=', $this->gridStartsAt)
                ->whereDate('workout_date', '<=', $this->gridEndsAt)
                ->get()
                ->map(function (EventSubtypeWorkout $workout) {
                    return [
                        'id' => $workout->id,
                        'title' => $workout->title,
                        'description' => $workout->description,
                        'date' => $workout->workout_date,
                    ];
                });
        }

    public function onEventClick($eventId)
    {
        $this->emit('showEventModal', $eventId);
    }

    public function onEventDropped($eventId, $year, $month, $day)
    {
        HurdleWorkout::where('id', $eventId)->update(['workout_date' => $year . '-' . $month . '-' . $day]);
    }

}
