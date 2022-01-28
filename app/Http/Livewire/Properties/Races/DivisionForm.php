<?php

namespace App\Http\Livewire\Properties\Races;

use App\Models\Properties\Races\Division;
use App\Models\Properties\Races\Gender;
use App\Models\Properties\Races\Level;
use Livewire\Component;
use function view;

class DivisionForm extends Component
{
    public $division = null;
    public $gender_id;
    public $level_id;

    protected $listeners = [
        'cancelCreate' => 'resetForm',
        'submitCreate' => 'submitForm',
        'editDivision'
    ];

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function editDivision(Division $division)
    {
        $this->division = $division;
        $this->gender_id = $this->division->gender_id;
        $this->level_id = $this->division->level_id;
    }

    public function rules()
    {
        return [
            'gender_id' => 'required|string|max:50',
            'level_id' => 'required|string|max:50',
        ];
    }

    public function submitForm()
    {
        $this->validate();

        $division = [
            'gender_id' => $this->gender_id,
            'level_id' => $this->level_id,
        ];

        if ($this->division) {
            Division::find($this->division->id)->update($division);
            $this->emit('recordUpdated');
        } else {
            Division::create($division);
            $this->emit('recordAdded');
        }
        $this->resetForm();
        $this->emit('hideFormModal');
    }

    public function resetForm()
    {
        $this->reset(['gender_id', 'level_id']);
    }

    public function render()
    {
        return view('livewire.properties.races.division-form', [
            'genders' => Gender::all(),
            'levels' => Level::all()
        ]);
    }
}
