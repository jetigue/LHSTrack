<?php

namespace App\Http\Livewire\Athletes;

use App\Models\Athletes\Athlete;
use App\Models\Properties\Events\Track\TrackEventSubtype;
use Livewire\Component;

class AthleteForm extends Component
{
    public $athlete = null;
    public $first_name;
    public $last_name;
    public $sex;
    public $dob_for_editing;
    public $grad_year;
    public $status;
    public $user_id;
    public $track_event_subtype_id;
    public $physical_expiration_date_for_editing;

    protected $listeners = [
        'cancelCreate' => 'resetForm',
        'submitCreate' => 'submitForm',
        'editAthlete'
    ];

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function editAthlete(Athlete $athlete)
    {
        $this->athlete = $athlete;
        $this->first_name = $this->athlete->first_name;
        $this->last_name = $this->athlete->last_name;
        $this->sex = $this->athlete->sex;
        $this->dob_for_editing = $this->athlete->dob_for_editing;
        $this->grad_year = $this->athlete->grad_year;
        $this->status = $this->athlete->status;
        $this->user_id = $this->athlete->user_id;
        $this->track_event_subtype_id = $this->athlete->track_event_subtype_id;
        $this->physical_expiration_date_for_editing = $this->athlete->physical_expiration_date_for_editing;
    }

    public function rules()
    {
        return [
            'first_name' => 'required|string|max:50',
            'last_name' => 'required|string|max:50',
            'sex' => 'required|in:m,f',
            'grad_year' => 'required|integer|between:2010,2030',
            'dob_for_editing' => 'nullable|date',
            'status' => 'required|in:a,i,e',
            'physical_expiration_date_for_editing' => 'nullable|date',
            'track_event_subtype_id' => 'nullable|integer'
        ];
    }

    public function submitForm()
    {
        $this->validate();

        $athlete = [
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'sex' => $this->sex,
            'grad_year' => $this->grad_year,
            'dob' => $this->dob_for_editing,
            'status' => $this->status,
            'physical_expiration_date' => $this->physical_expiration_date_for_editing,
            'track_event_subtype_id' => $this->track_event_subtype_id,
        ];

        if ($this->athlete) {
            Athlete::find($this->athlete->id)->update($athlete);
            $this->emit('recordUpdated');
        } else {
            $athlete = Athlete::create($athlete);
            $this->emit('recordAdded');
        }
        $this->resetForm();
        $this->emit('hideFormModal');
    }

    public function resetForm()
    {
        $this->reset([
            'first_name',
            'last_name',
            'sex',
            'grad_year',
            'dob_for_editing',
            'status',
            'physical_expiration_date_for_editing',
            'track_event_subtype_id'
        ]);
    }

    public function render()
    {
        return view('livewire.athletes.athlete-form', [
            'categories' => TrackEventSubtype::orderBy('name')->get()
        ]);
    }
}
