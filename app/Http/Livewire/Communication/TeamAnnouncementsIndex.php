<?php

namespace App\Http\Livewire\Communication;

use App\Models\Communication\TeamAnnouncement;
use Livewire\Component;

class TeamAnnouncementsIndex extends Component
{
    public $showFormModal = false;

    public $editing = false;

    public $announcement;

    public $showConfirmModal = false;

    public $borderColor = 'white';

    protected $listeners = [
        'hideModal',
        'showFormModal',
        'confirmDelete',
    ];

    public function showFormModal()
    {
        $this->showFormModal = true;
    }

    public function hideModal()
    {
        $this->showFormModal = false;
    }

    public function previewAnnouncement(TeamAnnouncement $announcement): TeamAnnouncement
    {
        return $this->displayedAnnouncement = $announcement;
    }

    public function confirmDelete(TeamAnnouncement $announcement)
    {
        $this->showConfirmModal = true;
        $this->announcement = $announcement;
    }

    public function destroy()
    {
        $this->announcement->delete();
        $this->showConfirmModal = false;
        $this->updated();
    }

    public function updated()
    {
        return $this->displayedAnnouncement = TeamAnnouncement::with('owner')
                            ->orderBy('updated_at', 'desc')->first();
    }

    public function cancel()
    {
        $this->showFormModal = false;
        $this->editing = false;

        $this->emit('cancelCreate');
    }

    public function editAnnouncement(TeamAnnouncement $announcement)
    {
        $this->showFormModal = true;
        $this->editing = true;
        $this->emit('editAnnouncement', $announcement->id);
    }

    public function render()
    {
        return view('livewire.communication.team-announcements-index', [

            'announcements' => TeamAnnouncement::with('owner')
                ->orderBy('updated_at', 'desc')->get(),

            'displayedAnnouncement' => TeamAnnouncement::with('owner')
                ->orderBy('end_date', 'desc')->first(),
        ]);
    }
}
