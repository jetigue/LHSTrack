<?php

namespace App\Http\Livewire\Properties\Events;

use App\Models\Properties\Events\EventCategory;
use App\Models\Properties\Events\TrackEvent;
use Livewire\Component;

class TrackEventForm extends Component
{
    public $trackEvent = null;
    public $name;
    public $event_category_id;
    public $distance_in_meters;

    protected $listeners = [
        'cancelCreate' => 'resetForm',
        'submitCreate' => 'submitForm',
        'editTrackEvent'
    ];

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function editTrackVenue(TrackEvent $trackEvent)
    {
        $this->trackEvent = $trackEvent;
        $this->name = $this->trackEvent->name;
        $this->event_category_id = $this->trackEvent->event_category_id;
        $this->distance_in_meters = $this->trackEvent->distance_in_meters;
    }

    public function rules()
    {
        return [
            'name' => 'required|string|max:50',
            'event_category_id' => 'required|integer',
            'distance_in_meters' => 'nullable|integer'
        ];
    }

    public function submitForm()
    {
        $this->validate();

        $trackEvent = [
            'name' => $this->name,
            'event_category_id' => $this->event_category_id,
            'distance_in_meters' => $this->distance_in_meters
        ];

        if ($this->trackEvent) {
            TrackEvent::find($this->trackEvent->id)->update($trackEvent);
            $this->emit('recordUpdated');
        } else {
            TrackEvent::create($trackEvent);
            $this->emit('recordAdded');
        }
        $this->resetForm();
        $this->emit('hideFormModal');
    }

    public function resetForm()
    {
        $this->reset(['name', 'event_category_id', 'distance_in_meters']);
    }

    public function render()
    {
        return view('livewire.properties.events.track-event-form', [
            'categories' => EventCategory::all()
        ]);
    }
}
