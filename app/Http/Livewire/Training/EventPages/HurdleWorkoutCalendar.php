<?php

namespace App\Http\Livewire\Training\EventPages;

use App\Models\Training\Workouts\HurdleWorkout;
use Asantibanez\LivewireCalendar\LivewireCalendar;
use Illuminate\Support\Collection;

class HurdleWorkoutCalendar extends LivewireCalendar
{

    public function events(): Collection
        {
            return HurdleWorkout ::query()
                ->whereDate('workout_date', '>=', $this->gridStartsAt)
                ->whereDate('workout_date', '<=', $this->gridEndsAt)
                ->get()
                ->map(function (HurdleWorkout $workout) {
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
