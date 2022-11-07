<?php

namespace App\Http\Livewire\Properties\Events\Track;

use App\Models\Properties\Events\Track\TrackEventType;
use Livewire\Component;

class TrackEventTypesIndex extends Component
{
    public $eventType = '';

    public $editing = false;

    public $showFormModal = false;

    public bool $showConfirmModal = false;

    protected $listeners = [
        'hideFormModal',
        'showFormModal',
        'confirmDelete',
        'recordAdded',
        'recordUpdated',
    ];

    public function showFormModal()
    {
        $this->showFormModal = true;
    }

    public function hideFormModal()
    {
        $this->showFormModal = false;
    }

    public function recordAdded()
    {
        session()->flash('success', 'Track Event Type Added');
    }

    public function recordUpdated()
    {
        session()->flash('success', 'Track Event Type Updated');
    }

    public function confirmDelete(TrackEventType $eventType)
    {
        $this->eventType = $eventType;
        $this->showConfirmModal = true;
    }

    public function destroy(TrackEventType $eventType)
    {
        $this->eventType->delete();
        $this->showConfirmModal = false;
        session()->flash('success', 'Track Event Type Deleted Successfully');
    }

    public function cancel()
    {
        $this->showFormModal = false;
        $this->editing = false;

        $this->emit('cancelCreate');
    }

    public function editRecord(TrackEventType $eventType)
    {
        $this->showFormModal = true;
        $this->editing = true;
        $this->emit('editEventType', $eventType->id);
    }

    public function render()
    {
        return view('livewire.properties.events.track.track-event-types-index', [
            'eventTypes' => TrackEventType::with('subTypes', 'trackEvents')->get(),
        ]);
    }
}
