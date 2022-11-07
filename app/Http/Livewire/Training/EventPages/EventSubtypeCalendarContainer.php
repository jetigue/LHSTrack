<?php

namespace App\Http\Livewire\Training\EventPages;

use Illuminate\Support\Facades\Route;
use App\Models\Communication\EventSubtypes\EventSubtypeLink;
use App\Models\Properties\Events\Track\TrackEventSubtype;
use App\Models\Training\Workouts\EventSubtypeWorkout;
use App\Models\Training\Workouts\HurdleWorkout;
use Livewire\Component;

class EventSubtypeCalendarContainer extends Component
{
    public $workout;

    public bool $showEventModal = false;

    public $event;

    public $eventSubtype;

    public function mount()
    {
        $this->event = str_ireplace(' Calendar', '', \Route::currentRouteName());
        $this->eventSubtype = TrackEventSubtype::firstWhere('name', 'LIKE', "%$this->event%");
    }

    protected $listeners = ['showEventModal' => 'showModal'];

    public function showModal($workoutId)
    {
        $this->workout = EventSubtypeWorkout::firstWhere('id', $workoutId);

        $this->showEventModal = true;
    }

    public function showMobileModal(EventSubtypeWorkout $workout)
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
        return view('livewire.training.event-pages.event-subtype-calendar-container', [
            'workouts' => HurdleWorkout::query()->orderBy('workout_date')->get(),

            'links' => EventSubtypeLink::where('track_event_subtype_id', $this->eventSubtype->id)
                ->get(),

            'eventSubtypes' => TrackEventSubtype::where('name', '!=', 'Relays')->orderBy('name')->get(),
        ]);
    }
}
