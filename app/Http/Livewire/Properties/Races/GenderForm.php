<?php

namespace App\Http\Livewire\Properties\Races;

use App\Models\Properties\Races\Gender;
use Livewire\Component;
use function view;

class GenderForm extends Component
{
    public $gender = null;

    public $name;

    protected $listeners = [
        'cancelCreate' => 'resetForm',
        'submitCreate' => 'submitForm',
        'editGender',
    ];

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function editGender(Gender $gender)
    {
        $this->gender = $gender;
        $this->name = $this->gender->name;
    }

    public function rules()
    {
        return [
            'name' => 'required|string|max:50',
        ];
    }

    public function submitForm()
    {
        $this->validate();

        $gender = [
            'name' => $this->name,
        ];

        if ($this->gender) {
            Gender::find($this->gender->id)->update($gender);
            $this->emit('recordUpdated');
        } else {
            Gender::create($gender);
            $this->emit('recordAdded');
        }
        $this->resetForm();
        $this->emit('hideFormModal');
    }

    public function resetForm()
    {
        $this->reset(['name']);
    }

    public function render()
    {
        return view('livewire.properties.races.gender-form');
    }
}
