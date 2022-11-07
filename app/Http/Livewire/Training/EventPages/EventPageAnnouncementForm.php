<?php

namespace App\Http\Livewire\Training\EventPages;

use App\Models\Communication\EventSubtypes\EventSubtypeAnnouncement;
use App\Models\Properties\Events\Track\TrackEventSubtype;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Mews\Purifier\Facades\Purifier;

class EventPageAnnouncementForm extends Component
{
    public TrackEventSubtype $eventSubtype;

    public $announcement = '';

    public $title;

    public $begin_date_for_editing;

    public $end_date_for_editing;

    public $body;

    protected $listeners = [
        'cancelCreate' => 'resetForm',
        'submitCreate' => 'submitForm',
        'editAnnouncement',
    ];

    public function mount()
    {
        $this->content = $this->body;
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function rules()
    {
        return [
            'title' => 'required',
            'begin_date_for_editing' => 'required|date',
            'end_date_for_editing' => 'required|date|after:begin_date',
            'body' => 'required',
        ];
    }

    public function editAnnouncement(EventSubtypeAnnouncement $announcement)
    {
        $this->announcement = $announcement;
        $this->title = $this->announcement->title;
        $this->begin_date_for_editing = $this->announcement->begin_date_for_editing;
        $this->end_date_for_editing = $this->announcement->end_date_for_editing;
        $this->body = $this->announcement->body;
    }

    public function submitForm()
    {
        $this->validate();

        $announcement = [
            'begin_date' => $this->begin_date_for_editing,
            'end_date' => $this->end_date_for_editing,
            'title' => $this->title,
            'body' => Purifier::clean($this->body),
            'user_id' => Auth::user()->id,
            'track_event_subtype_id' => $this->eventSubtype->id,
        ];

        if ($this->announcement) {
            EventSubtypeAnnouncement::find($this->announcement->id)->update($announcement);
            $this->emit('recordUpdated');
        } else {
            EventSubtypeAnnouncement::create($announcement);
            $this->emit('recordAdded');
        }
        $this->resetForm();
        $this->emit('hideFormModal');
    }

    public function resetForm()
    {
        $this->reset([
            'begin_date_for_editing',
            'end_date_for_editing',
            'title',
            'body',
        ]);
    }

    public function render()
    {
        return view('livewire.training.event-pages.event-page-announcement-form');
    }
}
