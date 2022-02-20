<?php

namespace App\Http\Livewire\Training\EventPages;

use App\Models\Communication\EventSubtypes\EventSubtypeLink;
use App\Models\Properties\Events\Track\TrackEventSubtype;
use Auth;
use Livewire\Component;

class EventPageLinkForm extends Component
{
    public TrackEventSubtype $eventSubtype;
    public $link = null;
    public $text;
    public $url;

    protected $listeners = [
        'cancelCreate' => 'resetForm',
        'submitCreate' => 'submitForm',
        'editLink'
    ];

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function rules()
    {
        return [
            'text' => 'required|string',
            'url' => 'required|url',
        ];
    }

    public function editLink(EventSubtypeLink $link)
    {
        $this->link = $link;
        $this->text = $this->link->text;
        $this->url = $this->link->url;
    }

    public function submitForm()
    {
        $this->validate();

        $link = [
            'text' => $this->text,
            'url' => $this->url,
            'user_id' => Auth::user()->id,
            'track_event_subtype_id' => $this->eventSubtype->id
        ];

        if ($this->link) {
            EventSubtypeLink::find($this->link->id)->update($link);
            $this->emit('recordUpdated');
        } else {
            EventSubtypeLink::create($link);
            $this->emit('recordAdded');
        }

        $this->emit('hideFormModal');
        $this->resetForm();
    }

    public function resetForm()
    {
        $this->reset([
            'text',
            'url',
        ]);
    }
    public function render()
    {
        return view('livewire.training.event-pages.event-page-link-form');
    }
}
