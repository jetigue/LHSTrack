<?php

namespace App\Http\Livewire\Training\EventPages;

use App\Models\Properties\Events\Track\TrackEventSubtype;
use App\Models\Training\Workouts\EventSubtypeWorkout;
use Carbon\Carbon;
use Livewire\Component;

class EventPageWorkoutsIndex extends Component
{
    public TrackEventSubtype $eventSubtype;

    public $showFormModal = false;

    public $editing = false;

    public $workout;

    public $showConfirmModal = false;

    public $timeFrame = '>=';

    public $whichWorkouts = 'Upcoming';

    public $viewWorkout = false;

    protected $listeners = [
        'hideFormModal',
        'showFormModal',
        'confirmDelete',
        'recordAdded',
        'recordUpdated',
    ];

    public function showFormModal()
    {
        $this->showFormModal = true;
    }

    public function hideFormModal()
    {
        $this->showFormModal = false;
    }

    public function showWorkoutModal(): bool
    {
        return $this->viewWorkout = true;
    }

    public function hideWorkoutModal(): bool
    {
        return $this->viewWorkout = false;
    }

    public function confirmDelete(EventSubtypeWorkout $workout)
    {
        $this->showConfirmModal = true;
        $this->workout = $workout;
    }

    public function destroy()
    {
        $this->workout->delete();
        $this->showConfirmModal = false;
        session()->flash('success', 'Workout Deleted Successfully');
        $this->render();
    }

    public function updatedTimeFrame(): string
    {
        if ($this->timeFrame == '>=') {
            return $this->whichWorkouts = 'Upcoming';
        } elseif ($this->timeFrame == '<') {
            return $this->whichWorkouts = 'Past';
        }

        return $this->whichWorkouts = 'All';
    }

    public function cancel()
    {
        $this->showFormModal = false;
        $this->editing = false;

        $this->emit('cancelCreate');
    }

    public function edit(EventSubtypeWorkout $workout)
    {
        $this->showFormModal = true;
        $this->editing = true;
        $this->emit('editWorkout', $workout->id);
    }

    public function recordAdded()
    {
        session()->flash('success', 'Workout Successfully Added!');
    }

    public function recordUpdated()
    {
        session()->flash('success', 'Workout Updated!');
    }

    public function render()
    {
        return view('livewire.training.event-pages.event-page-workouts-index', [
            'workouts' => EventSubtypeWorkout::query()
                ->where('track_event_subtype_id', $this->eventSubtype->id)
                ->when($this->timeFrame, function ($query, $timeFrame) {
                    return $query->where('workout_date', $timeFrame, Carbon::now());
                })
                ->orderBy('workout_date')
                ->paginate(25),
        ]);
    }
}
