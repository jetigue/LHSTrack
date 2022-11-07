<?php

namespace App\Http\Livewire\Properties\Events\Track;

use App\Models\Properties\Events\Track\TrackEvent;
use Livewire\Component;
use function session;
use function view;

class TrackEventsIndex extends Component
{
    public $trackEvent = '';

    public $editing = false;

    public $showFormModal = false;

    public $showConfirmModal = false;

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

    public function clearSearch()
    {
        $this->reset('search');
    }

    public function recordAdded()
    {
        session()->flash('success', 'Track Event Added');
    }

    public function recordUpdated()
    {
        session()->flash('success', 'Track Event Updated');
    }

    public function confirmDelete(TrackEvent $trackEvent)
    {
        $this->trackEvent = $trackEvent;
        $this->showConfirmModal = true;
    }

    public function destroy(TrackEvent $trackEvent)
    {
        $this->trackEvent->delete();
        $this->showConfirmModal = false;
        session()->flash('success', 'Track Event Deleted Successfully');
    }

    public function cancel()
    {
        $this->showFormModal = false;
        $this->editing = false;

        $this->emit('cancelCreate');
    }

    public function editRecord(TrackEvent $trackEvent)
    {
        $this->showFormModal = true;
        $this->editing = true;
        $this->emit('editTrackEvent', $trackEvent->id);
    }

    public function render()
    {
        return view('livewire.properties.events.track.track-events-index', [
            'trackEvents' => TrackEvent::with('eventSubtype')
                ->orderBy('track_event_subtype_id')
                ->orderBy('distance_in_meters')
                ->orderBy('name')
                ->get(),
        ]);
    }
}
