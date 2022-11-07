<?php

namespace App\Http\Livewire\Properties\Events\Track;

use App\Models\Properties\Events\Track\TrackEventType;
use Livewire\Component;

class TrackEventTypeForm extends Component
{
    public $eventType = null;

    public $name;

    protected $listeners = [
        'cancelCreate' => 'resetForm',
        'submitCreate' => 'submitForm',
        'editEventType',
    ];

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function editEventType(TrackEventType $eventType)
    {
        $this->eventType = $eventType;
        $this->name = $this->eventType->name;
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

        $eventType = [
            'name' => $this->name,
        ];

        if ($this->eventType) {
            TrackEventType::find($this->eventType->id)->update($eventType);
            $this->emit('recordUpdated');
        } else {
            TrackEventType::create($eventType);
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
        return view('livewire.properties.events.track.track-event-type-form');
    }
}
