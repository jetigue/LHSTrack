<?php

namespace App\Http\Livewire\Properties\Meets\Track;

use App\Models\Properties\Meets\Track\Venue;
use Illuminate\Support\Facades\Route;
use Livewire\Component;
use Livewire\WithPagination;

class TrackVenuesIndex extends Component
{
    use WithPagination;

    public $search = '';
    public $sortField = 'name';
    public $sortDirection = 'asc';
    public $trackVenue = '';
    public $editing = false;
    public $showFormModal = false;
    public $showConfirmModal = false;
    public $route;

    protected $queryString = ['sortField', 'sortDirection', 'search'];

    public function sortBy($field)
    {
        if ($this->sortField === $field) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortDirection = 'asc';
        }

        $this->sortField = $field;
    }

    protected $listeners = [
        'hideFormModal',
        'showFormModal',
        'confirmDelete',
        'recordAdded',
        'recordUpdated',
    ];

    public function mount()
    {
        $this->route = Route::currentRouteName();
    }

    public function showFormModal() { $this->showFormModal = true; }
    public function hideFormModal() { $this->showFormModal = false; }

    public function clearSearch()
    {
        $this->reset('search');
    }

    public function recordAdded()
    {
        session()->flash('success', 'Track Venue Added');
    }

    public function recordUpdated()
    {
        session()->flash('success', 'Track Venue Updated');
    }

    public function confirmDelete(Venue $trackVenue)
    {
        $this->trackVenue = $trackVenue;
        $this->showConfirmModal = true;
    }

    public function destroy(Venue $trackVenue)
    {
        $this->trackVenue->delete();
        $this->showConfirmModal = false;
        session()->flash('success', 'Track Venue Deleted Successfully');
    }

    public function cancel()
    {
        $this->showFormModal = false;
        $this->editing = false;

        $this->emit('cancelCreate');
    }

    public function editRecord(Venue $trackVenue)
    {
        $this->showFormModal = true;
        $this->editing = true;
        $this->emit('editTrackVenue', $trackVenue->id);
    }

    public function render()
    {
        return view('livewire.properties.meets.track.track-venues-index', [
            'trackVenues' => Venue::query()
                ->where('name', 'like', '%' . $this->search . '%')
                ->orderBy($this->sortField, $this->sortDirection)
                ->orderBy('name')
                ->paginate(25)
        ]);
    }
}
