<?php

namespace App\Http\Livewire\Properties\Meets;

use App\Models\Properties\Meets\Timing;
use Livewire\Component;

class TimingMethodForm extends Component
{
    public $timingMethod = null;
    public $name;

    protected $listeners = [
        'cancelCreate' => 'resetForm',
        'submitCreate' => 'submitForm',
        'editTimingMethod'
    ];

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function editTimingMethod(Timing $timingMethod)
    {
        $this->timingMethod = $timingMethod;
        $this->name = $this->timingMethod->name;
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

        $timingMethod = [
            'name' => $this->name,
        ];

        if ($this->timingMethod) {
            Timing::find($this->timingMethod->id)->update($timingMethod);
            $this->emit('recordUpdated');
        } else {
            $timingMethod = Timing::create($timingMethod);
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
        return view('livewire.properties.meets.timing-method-form');
    }
}
