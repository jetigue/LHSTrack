<?php

namespace App\Http\Livewire\Properties\Events\Track;

use App\Models\Properties\Events\Track\TrackEvent;
use App\Models\Properties\Events\Track\TrackEventSubtype;
use Livewire\Component;
use function view;

class TrackEventForm extends Component
{
    public $trackEvent = null;

    public $name;

    public $track_event_subtype_id;

    public $distance_in_meters;

    public $boys_event;

    public $girls_event;

    public $ghsa_event;

    protected $listeners = [
        'cancelCreate' => 'resetForm',
        'submitCreate' => 'submitForm',
        'editTrackEvent',
    ];

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function updatedDistanceInMeters($value)
    {
        if ($value) {
            return $this->distance_in_meters;
        }

        return $this->distance_in_meters = null;
    }

    public function editTrackEvent(TrackEvent $trackEvent)
    {
        $this->trackEvent = $trackEvent;
        $this->name = $this->trackEvent->name;
        $this->track_event_subtype_id = $this->trackEvent->track_event_subtype_id;
        $this->distance_in_meters = $this->trackEvent->distance_in_meters;
        $this->boys_event = $this->trackEvent->boys_event;
        $this->girls_event = $this->trackEvent->girls_event;
        $this->ghsa_event = $this->trackEvent->ghsa_event;
    }

    public function rules()
    {
        return [
            'name' => 'required|string|max:50',
            'track_event_subtype_id' => 'required|integer',
            'distance_in_meters' => 'integer|nullable',
            'boys_event' => 'required|boolean',
            'girls_event' => 'required|boolean',
            'ghsa_event' => 'required|boolean',
        ];
    }

    public function submitForm()
    {
        $this->validate();

        $trackEvent = [
            'name' => $this->name,
            'track_event_subtype_id' => $this->track_event_subtype_id,
            'distance_in_meters' => $this->distance_in_meters,
            'boys_event' => $this->boys_event,
            'girls_event' => $this->girls_event,
            'ghsa_event' => $this->ghsa_event,
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
        $this->reset([
            'name',
            'track_event_subtype_id',
            'distance_in_meters',
            'boys_event',
            'girls_event',
            'ghsa_event',
        ]);
    }

    public function render()
    {
        return view('livewire.properties.events.track.track-event-form', [
            'trackSubTypes' => TrackEventSubtype::all(),
        ]);
    }
}
