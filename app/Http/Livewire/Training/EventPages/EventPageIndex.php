<?php

namespace App\Http\Livewire\Training\EventPages;

use App\Models\Communication\EventSubtypes\EventSubtypeLink;
use App\Models\Properties\Events\Track\TrackEventSubtype;

use Livewire\Component;


class EventPageIndex extends Component
{
    public $event;
    public $eventSubtype;

    public function mount()
    {
        $this->event = \Route::currentRouteName();
        $this->eventSubtype = TrackEventSubtype::firstWhere('name', 'LIKE', "%$this->event%");
    }

    public function render()
    {
        return view('livewire.training.event-pages.event-page-index', [
            'links' => EventSubtypeLink::query()
                ->where('track_event_subtype_id', $this->eventSubtype->id)
                ->get(),

            'eventSubtypes' => TrackEventSubtype::where('name', '!=', 'Relays')->orderBy('name')->get()
        ]);
    }
}
