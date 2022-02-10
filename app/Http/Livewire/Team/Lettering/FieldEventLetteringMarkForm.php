<?php

namespace App\Http\Livewire\Team\Lettering;

use App\Models\Properties\Events\Track\TrackEvent;
use App\Models\Team\FieldEventLetteringMark;
use Livewire\Component;

class FieldEventLetteringMarkForm extends Component
{
    public $mark = null;
    public $track_event_id;

    public $freshman_feet;
    public $freshman_inches;
    public $freshman_quarter_inch;
    public $freshman_total_inches;
    public $gender_id;
    public $junior_feet;
    public $junior_inches;
    public $junior_quarter_inch;
    public $junior_total_inches;
    public $senior_feet;
    public $senior_inches;
    public $senior_quarter_inch;
    public $senior_total_inches;
    public $sophomore_feet;
    public $sophomore_inches;
    public $sophomore_quarter_inch;
    public $sophomore_total_inches;

    protected $listeners = [
        'cancelCreate' => 'resetForm',
        'submitCreate' => 'submitForm',
        'editMark'
    ];

    public function mount($gender)
    {
        return $this->gender_id = $gender->id;
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function editMark(FieldEventLetteringMark $mark)
    {
        $this->mark = $mark;
        $this->track_event_id = $this->mark->track_event_id;
        $this->freshman_total_inches = $this->mark->freshman_total_inches;
        $this->freshman_feet = floor($this->mark->freshman_total_inches / 12);
        $this->freshman_inches = $this->mark->freshman_total_inches % 12;
        $this->freshman_quarter_inch = $this->mark->freshman_quarter_inch;
        $this->sophomore_total_inches = $this->mark->sophomore_total_inches;
        $this->sophomore_feet = floor($this->mark->sophomore_total_inches / 12);
        $this->sophomore_inches = $this->mark->sophomore_total_inches % 12;
        $this->sophomore_quarter_inch = $this->mark->sophomore_quarter_inch;
        $this->junior_total_inches = $this->mark->junior_total_inches;
        $this->junior_feet = floor($this->mark->junior_total_inches / 12);
        $this->junior_inches = $this->mark->junior_total_inches % 12;
        $this->junior_quarter_inch = $this->mark->junior_quarter_inch;
        $this->senior_total_inches = $this->mark->senior_total_inches;
        $this->senior_feet = floor($this->mark->senior_total_inches / 12);
        $this->senior_inches = $this->mark->senior_total_inches % 12;
        $this->senior_quarter_inch = $this->mark->senior_quarter_inch;
        $this->gender_id = $this->mark->gender_id;
    }

    public function rules()
    {
        return [
            'track_event_id' => 'required|integer',
            'freshman_feet' => 'integer|required',
            'freshman_inches' => 'integer|nullable',
            'freshman_quarter_inch' => 'nullable|integer|min:0|max:3',
            'sophomore_feet' => 'integer|required',
            'sophomore_inches' => 'integer|nullable',
            'sophomore_quarter_inch' => 'nullable|integer|min:0|max:3',
            'junior_feet' => 'integer|required',
            'junior_inches' => 'integer|nullable',
            'junior_quarter_inch' => 'nullable|integer|min:0|max:3',
            'senior_feet' => 'integer|required',
            'senior_inches' => 'integer|nullable',
            'senior_quarter_inch' => 'nullable|integer|min:0|max:3',
        ];
    }

    public function submitForm()
    {
        $this->validate();

        $mark = [
            'track_event_id' => $this->track_event_id,
            'gender_id' => $this->gender_id,
            'freshman_total_inches' => ($this->freshman_feet * 12) + $this->freshman_inches,
            'freshman_quarter_inch' => $this->freshman_quarter_inch,
            'sophomore_total_inches' => ($this->sophomore_feet * 12) + $this->sophomore_inches,
            'sophomore_quarter_inch' => $this->sophomore_quarter_inch,
            'junior_total_inches' => ($this->junior_feet * 12) + $this->junior_inches,
            'junior_quarter_inch' => $this->junior_quarter_inch,
            'senior_total_inches' => ($this->senior_feet * 12) + $this->senior_inches,
            'senior_quarter_inch' => $this->senior_quarter_inch,
        ];

        if ($this->mark) {
            FieldEventLetteringMark::find($this->mark->id)->update($mark);
            $this->emit('recordUpdated');
        } else {
            FieldEventLetteringMark::create($mark);
            $this->emit('recordAdded');
        }
        $this->resetForm();
        $this->emit('hideFormModal');
    }

    public function resetForm()
    {
        $this->reset([
            'track_event_id',
            'freshman_feet',
            'freshman_inches',
            'freshman_quarter_inch',
            'sophomore_feet',
            'sophomore_inches',
            'sophomore_quarter_inch',
            'junior_feet',
            'junior_inches',
            'junior_quarter_inch',
            'senior_feet',
            'senior_inches',
            'senior_quarter_inch',
        ]);
    }

    function render()
    {
        return view('livewire.team.lettering.field-event-lettering-mark-form', [
            'fieldEvents' => TrackEvent::where('distance_in_meters', '=', null)->get()
        ]);
    }
}
