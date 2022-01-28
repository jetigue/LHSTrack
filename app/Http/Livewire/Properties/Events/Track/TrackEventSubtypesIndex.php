<?php

namespace App\Http\Livewire\Properties\Events\Track;

use App\Models\Properties\Events\Track\TrackEventSubtype;
use Livewire\Component;
use function session;
use function view;

class TrackEventSubtypesIndex extends Component
{
    public $subType = '';
    public $editing = false;
    public $showFormModal = false;
    public bool $showConfirmModal = false;

    protected $listeners = [
        'hideFormModal',
        'showFormModal',
        'confirmDelete',
        'recordAdded',
        'recordUpdated'
    ];

    public function showFormModal() { $this->showFormModal = true; }
    public function hideFormModal() { $this->showFormModal = false; }

    public function recordAdded()
    {
        session()->flash('success', 'Track Event Subtype Added');
    }

    public function recordUpdated()
    {
        session()->flash('success', 'Track Event Subtype Updated');
    }

    public function confirmDelete(TrackEventSubtype $subType)
    {
        $this->subType = $subType;
        $this->showConfirmModal = true;
    }

    public function destroy(TrackEventSubtype $subType)
    {
        $this->subType->delete();
        $this->showConfirmModal = false;
        session()->flash('success', 'Track Event Subtype Deleted Successfully');
    }

    public function cancel()
    {
        $this->showFormModal = false;
        $this->editing = false;

        $this->emit('cancelCreate');
    }

    public function editRecord(TrackEventSubtype $subType)
    {
        $this->showFormModal = true;
        $this->editing = true;
        $this->emit('editSubType', $subType->id);
    }

    public function render()
    {
        return view('livewire.properties.events.track.track-event-subtypes-index', [
            'subTypes' => TrackEventSubtype::with('eventType', 'trackEvents')->get()
        ]);
    }
}
