<?php

namespace App\Http\Livewire\Properties\Races;

use App\Models\Properties\Races\Level;
use Livewire\Component;
use function view;

class LevelForm extends Component
{
    public $level = null;
    public $name;

    protected $listeners = [
        'cancelCreate' => 'resetForm',
        'submitCreate' => 'submitForm',
        'editLevel'
    ];

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function editLevel(Level $level)
    {
        $this->level = $level;
        $this->name = $this->level->name;
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

        $level = [
            'name' => $this->name,
        ];

        if ($this->level) {
            Level::find($this->level->id)->update($level);
            $this->emit('recordUpdated');
        } else {
            Level::create($level);
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
        return view('livewire.properties.races.level-form');
    }
}
