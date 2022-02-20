<?php

namespace App\Http\Livewire\Training\EventPages;

use App\Models\Communication\EventSubtypes\EventSubtypeLink;
use App\Models\Properties\Events\Track\TrackEventSubtype;
use Livewire\Component;

class EventPageLinksIndex extends Component
{
    public TrackEventSubtype $eventSubtype;
    public $showFormModal = false;
    public $editing = false;
    public $link;
    public $showConfirmModal = false;

    protected $listeners = [
        'hideFormModal',
        'showFormModal',
        'confirmDelete',
        'recordAdded',
        'recordUpdated'
    ];

    public function showFormModal()
    {
        $this->showFormModal = true;
    }

    public function hideFormModal()
    {
        $this->showFormModal = false;
    }

    public function confirmDelete(EventSubtypeLink $link)
    {
        $this->showConfirmModal = true;
        $this->link = $link;
    }

    public function destroy()
    {
        $this->link->delete();
        $this->showConfirmModal = false;
        session()->flash('success', 'Link Deleted Successfully');
        $this->render();

    }

    public function recordAdded()
    {
        session()->flash('success', 'Link Successfully Added!');
    }

    public function recordUpdated()
    {
        session()->flash('success', 'Link Updated!');
    }

    public function cancel()
    {
        $this->showFormModal = false;
        $this->editing = false;

        $this->emit('cancelCreate');
    }

    public function edit(EventSubtypeLink $link)
    {
        $this->showFormModal = true;
        $this->editing = true;
        $this->emit('editLink', $link->id);
    }

    public function render()
    {
        return view('livewire.training.event-pages.event-page-links-index', [
            'links' => EventSubtypeLink::query()
                ->where('track_event_subtype_id', $this->eventSubtype->id)
                ->get(),
        ]);
    }
}
