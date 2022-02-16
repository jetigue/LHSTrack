<?php

namespace App\Http\Livewire\Training\EventPages;

use App\Models\Team\Links\HurdleLink;
use App\Models\Training\Workouts\HurdleWorkout;
use Livewire\Component;

class HurdleCalendarContainer extends Component
{
    public $workout;
    public bool $showEventModal = false;

    protected $listeners = ['showEventModal' => 'showModal'];

    public function showModal($workoutId)
    {
        $this->workout = HurdleWorkout::firstWhere('id', $workoutId);

        $this->showEventModal = true;
    }

    public function showMobileModal(HurdleWorkout $workout)
    {
        $this->workout = $workout;

        $this->showEventModal = true;
    }

    public function hideModal()
    {
        $this->showEventModal = false;
    }
    public function render()
    {
        return view('livewire.training.event-pages.hurdle-calendar-container', [
            'workouts' => HurdleWorkout::query()->orderBy('workout_date')->get(),

            'hurdleLinks' => HurdleLink::all()
        ]);
    }
}
