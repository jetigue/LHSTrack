<?php

namespace App\Http\Livewire\Training\EventPages;

use App\Models\Communication\EventSubtypes\EventSubtypeAnnouncement;
use App\Models\Properties\Events\Track\TrackEventSubtype;
use Carbon\Carbon;
use Livewire\Component;

class EventPageAnnouncementsIndex extends Component
{
    public TrackEventSubtype $eventSubtype;
    public $showFormModal = false;
    public $editing = false;
    public $announcement;
    public $showConfirmModal = false;
    public $timeFrame = '>=';
    public $whichAnnouncements = 'Upcoming';

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

    public function updatedTimeFrame(): string
    {
        if ($this->timeFrame == '>=') {
            return $this->whichAnnouncements = "Upcoming";
        } elseif ($this->timeFrame == '<') {
            return $this->whichAnnouncements = "Past";
        }
        return $this->whichAnnouncements = "All";
    }

    public function displayAnnouncement(EventSubtypeAnnouncement $announcement): EventSubtypeAnnouncement
    {
        return $this->displayedAnnouncement = $announcement;
    }

    public function previewAnnouncement(EventSubtypeAnnouncement $announcement): EventSubtypeAnnouncement
    {
        return $this->displayedAnnouncement = $announcement;
    }

    public function confirmDelete(EventSubtypeAnnouncement $announcement)
    {
        $this->showConfirmModal = true;
        $this->announcement = $announcement;
    }

    public function destroy()
    {
        $this->announcement->delete();
        $this->showConfirmModal = false;
        session()->flash('success', 'Announcement Deleted Successfully');
        $this->render();
    }

    public function updated()
    {
        return $this->displayedAnnouncement = EventSubtypeAnnouncement::with('owner')
            ->orderBy('updated_at', 'desc')->first();
    }

    public function recordAdded()
    {
        session()->flash('success', 'Announcement Successfully Added!');
    }

    public function recordUpdated()
    {
        session()->flash('success', 'Announcement Updated!');
    }

    public function cancel()
    {
        $this->showFormModal = false;
        $this->editing = false;

        $this->emit('cancelCreate');
    }

    public function edit(EventSubtypeAnnouncement $announcement)
    {
        $this->showFormModal = true;
        $this->editing = true;
        $this->emit('editAnnouncement', $announcement->id);
    }

    public function render()
    {
        return view('livewire.training.event-pages.event-page-announcements-index', [
            'announcements' => EventSubtypeAnnouncement::with('owner')
                ->where('track_event_subtype_id', $this->eventSubtype->id)
                ->when($this->timeFrame, function ($query, $timeFrame) {
                    return $query->where('end_date', $timeFrame, Carbon::now());
                })
                ->get(),

            'displayedAnnouncement' => EventSubtypeAnnouncement::with('owner')
                ->where('track_event_subtype_id', $this->eventSubtype->id)
                ->whereDate('end_date', '>=', Carbon::today())
                ->orderBy('updated_at', 'desc')->first(),
        ]);
    }
}
