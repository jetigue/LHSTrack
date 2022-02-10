<?php

namespace App\Http\Livewire\Communication;

use App\Models\Communication\TeamEvent;
use Carbon\Carbon;
use Livewire\Component;


class TeamEventsIndex extends Component
{
    public $showFormModal = false;
    public $editing = false;
    public $event;
    public $showConfirmModal = false;

    protected $listeners = [
        'hideModal',
        'showFormModal',
        'confirmDelete'
    ];

    public function showFormModal()
    {
        $this->showFormModal = true;
    }

    public function hideModal()
    {
        $this->showFormModal = false;
    }

    public function confirmDelete(TeamEvent $event)
    {
        $this->showConfirmModal = true;
        $this->event = $event;
    }

    public function destroy()
    {
        $this->event->delete();
        $this->showConfirmModal = false;
    }

    public function cancel()
    {
        $this->showFormModal = false;
        $this->editing = false;

        $this->emit('cancelCreate');
    }

    public function editEvent(TeamEvent $event)
    {
        $this->showFormModal =true;
        $this->editing = true;
        $this->emit('editEvent', $event->id);
    }

    public function render()
    {
        return view('livewire.communication.team-events-index', [
            'events' => TeamEvent::with('owner')
                ->orderBy('event_date')->get(),
        ]);
    }
}
