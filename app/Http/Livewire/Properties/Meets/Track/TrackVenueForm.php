<?php

namespace App\Http\Livewire\Properties\Meets\Track;

use App\Models\Properties\Meets\Track\Surface;
use App\Models\Properties\Meets\Track\Venue;
use Livewire\Component;

class TrackVenueForm extends Component
{
    public $trackVenue = null;
    public $name;
    public $track_surface_id;

    protected $listeners = [
        'cancelCreate' => 'resetForm',
        'submitCreate' => 'submitForm',
        'editTrackVenue'
    ];

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function editTrackVenue(Venue $venue)
    {
        $this->trackVenue = $venue;
        $this->name = $this->trackVenue->name;
        $this->track_surface_id = $this->trackVenue->track_surface_id;
    }

    public function rules()
    {
        return [
            'name' => 'required|string|max:50',
            'track_surface_id' => 'required|integer'
        ];
    }

    public function submitForm()
    {
        $this->validate();

        $trackVenue = [
            'name' => $this->name,
            'track_surface_id' => $this->track_surface_id
        ];

        if ($this->trackVenue) {
            Venue::find($this->trackVenue->id)->update($trackVenue);
            $this->emit('recordUpdated');
        } else {
            Venue::create($trackVenue);
            $this->emit('recordAdded');
        }
        $this->resetForm();
        $this->emit('hideFormModal');
    }

    public function resetForm()
    {
        $this->reset(['name', 'track_surface_id']);
    }

    public function render()
    {
        return view('livewire.properties.meets.track.track-venue-form', [
            'trackSurfaces' => Surface::orderBy('name')->get()
        ]);
    }
}
