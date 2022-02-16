<?php

namespace App\Http\Livewire\Training\EventPages;

use App\Models\Training\Workouts\HurdleWorkout;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Mews\Purifier\Facades\Purifier;

class HurdleWorkoutForm extends Component
{

    public $workout = null;
    public $title;
    public $workout_date_for_editing;
    public $description;

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

    public function editWorkout(HurdleWorkout $workout)
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
            'user_id' => Auth::user()->id
        ];

        if ($this->workout) {
            HurdleWorkout::find($this->workout->id)->update($workout);
        } else {
            HurdleWorkout::create($workout);
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
        return view('livewire.training.event-pages.hurdle-workout-form');
    }
}
