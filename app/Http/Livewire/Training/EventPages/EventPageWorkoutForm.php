<?php

namespace App\Http\Livewire\Training\EventPages;

use App\Models\Properties\Events\Track\TrackEventSubtype;
use App\Models\Training\Workouts\EventSubtypeWorkout;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Mews\Purifier\Facades\Purifier;

class EventPageWorkoutForm extends Component
{
    public $workout = null;
    public $title;
    public $workout_date_for_editing;
    public $track_event_subtype_id;
    public $description;
    public TrackEventSubtype $eventSubtype;

    protected $listeners = [
        'cancelCreate' => 'resetForm',
        'submitCreate' => 'submitForm',
        'editWorkout'
    ];

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function rules()
    {
        return [
            'title' => 'required',
            'workout_date_for_editing' => 'required|date',
            'description' => 'required'
        ];
    }

    public function editWorkout(EventSubtypeWorkout $workout)
    {
        $this->workout = $workout;
        $this->title = $this->workout->title;
        $this->workout_date_for_editing = $this->workout->workout_date_for_editing;
        $this->description = $this->workout->description;
    }

    public function submitForm()
    {
        $this->validate();

        $workout = [
            'workout_date' => $this->workout_date_for_editing,
            'title' => $this->title,
            'description' => Purifier::clean($this->description),
            'user_id' => Auth::user()->id,
            'track_event_subtype_id' => $this->eventSubtype->id
        ];

        if ($this->workout) {
            EventSubtypeWorkout::find($this->workout->id)->update($workout);
            $this->emit('recordUpdated');
        } else {
            EventSubtypeWorkout::create($workout);
            $this->emit('recordAdded');
        }

        $this->emit('hideFormModal');
        $this->resetForm();
    }

    public function resetForm()
    {
        $this->reset([
            'workout_date_for_editing',
            'title',
            'description',
        ]);
    }

    public function render()
    {
        return view('livewire.training.event-pages.event-page-workout-form');
    }
}
