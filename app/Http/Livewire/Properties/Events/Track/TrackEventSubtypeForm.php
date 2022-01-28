<?php

namespace App\Http\Livewire\Properties\Events\Track;

use App\Models\Properties\Events\Track\TrackEventSubtype;
use App\Models\Properties\Events\Track\TrackEventType;
use Livewire\Component;
use function view;

class TrackEventSubtypeForm extends Component
{
    public $subType = null;
    public $name;
    public $track_event_type_id;

    protected $listeners = [
        'cancelCreate' => 'resetForm',
        'submitCreate' => 'submitForm',
        'editSubType'
    ];

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function editSubType(TrackEventSubtype $subType)
    {
        $this->subType = $subType;
        $this->name = $this->subType->name;
    }

    public function rules()
    {
        return [
            'name' => 'required|string|max:50',
            'track_event_type_id' => 'required|integer'
        ];
    }

    public function submitForm()
    {
        $this->validate();

        $subType = [
            'name' => $this->name,
            'track_event_type_id' => $this->track_event_type_id,
        ];

        if ($this->subType) {
            TrackEventSubtype::find($this->subType->id)->update($subType);
            $this->emit('recordUpdated');
        } else {
            TrackEventSubtype::create($subType);
            $this->emit('recordAdded');
        }
        $this->resetForm();
        $this->emit('hideFormModal');
    }

    public function resetForm()
    {
        $this->reset(['name', 'track_event_type_id']);
    }

    public function render()
    {
        return view('livewire.properties.events.track.track-event-subtype-form', [
            'eventTypes' => TrackEventType::with('subTypes', 'trackEvents')->get()
        ]);
    }
}
