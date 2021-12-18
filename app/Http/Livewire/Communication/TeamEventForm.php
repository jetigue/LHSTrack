<?php

namespace App\Http\Livewire\Communication;

use App\Models\Communication\TeamEvent;
use Auth;
use Livewire\Component;
use Mews\Purifier\Facades\Purifier;

class TeamEventForm extends Component
{
    public $event = null;
    public $title;
    public $event_date_for_editing;
    public $description;

    protected $listeners = [
        'cancelCreate' => 'resetForm',
        'submitCreate' => 'submitForm',
        'editEvent' => 'edit'
    ];

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function rules()
    {
        return [
            'title' => 'required',
            'event_date_for_editing' => 'required|date',
            'description' => 'required'
        ];
    }

    public function edit(TeamEvent $event)
    {
        $this->event = $event;
        $this->title = $this->event->title;
        $this->event_date_for_editing = $this->event->event_date_for_editing;
        $this->description = $this->event->description;
    }

    public function submitForm()
    {
        $this->validate();

        $event = [
            'event_date' => $this->event_date_for_editing,
            'title' => $this->title,
            'description' => Purifier::clean($this->description),
            'user_id' => Auth::user()->id
        ];

        if ($this->event) {
            TeamEvent::find($this->event->id)->update($event);
        } else {
            $event = TeamEvent::create($event);
        }
        $this->resetForm();
        $this->emit('hideModal');
    }

    public function resetForm()
    {
        $this->reset([
            'event_date_for_editing',
            'title',
            'description',
        ]);
    }
    public function render()
    {
        return view('livewire.communication.team-event-form');
    }
}
