<?php

namespace App\Http\Livewire\Properties\Meets\Track;

use App\Models\Properties\Meets\Track\Surface;
use Livewire\Component;

class TrackSurfacesIndex extends Component
{
    public $surface = '';
    public $editing = false;
    public $showFormModal = false;
    public $showConfirmModal = false;

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
        session()->flash('success', 'TrackTimeTrial Surface Added');
    }

    public function recordUpdated()
    {
        session()->flash('success', 'TrackTimeTrial Surface Updated');
    }

    public function confirmDelete(Surface $surface)
    {
        $this->surface = $surface;
        $this->showConfirmModal = true;
    }

    public function destroy(Surface $surface)
    {
        $this->surface->delete();
        $this->showConfirmModal = false;
        session()->flash('success', 'TrackTimeTrial Surface Deleted Successfully');
    }

    public function cancel()
    {
        $this->showFormModal = false;
        $this->editing = false;

        $this->emit('cancelCreate');
    }

    public function editRecord(Surface $surface)
    {
        $this->showFormModal = true;
        $this->editing = true;
        $this->emit('editSurface', $surface->id);
    }

    public function render()
    {
        return view('livewire.properties.meets.track.track-surfaces-index', [
            'surfaces' => Surface::orderBy('name')->get()
        ]);
    }
}
