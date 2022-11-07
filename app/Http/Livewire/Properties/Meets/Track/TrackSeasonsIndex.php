<?php

namespace App\Http\Livewire\Properties\Meets\Track;

use App\Models\Properties\Meets\Track\Season;
use Livewire\Component;

class TrackSeasonsIndex extends Component
{
    public $season = '';

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

    public function recordAdded()
    {
        session()->flash('success', 'Season Added');
    }

    public function recordUpdated()
    {
        session()->flash('success', 'Season Updated');
    }

    public function confirmDelete(Season $season)
    {
        $this->season = $season;
        $this->showConfirmModal = true;
    }

    public function destroy(Season $season)
    {
        $this->season->delete();
        $this->showConfirmModal = false;
        session()->flash('success', 'Season Deleted Successfully');
    }

    public function cancel()
    {
        $this->showFormModal = false;
        $this->editing = false;

        $this->emit('cancelCreate');
    }

    public function editRecord(Season $season)
    {
        $this->showFormModal = true;
        $this->editing = true;
        $this->emit('editSeason', $season->id);
    }

    public function render()
    {
        return view('livewire.properties.meets.track.track-seasons-index', [
            'seasons' => Season::orderBy('name')->get(),
        ]);
    }
}
