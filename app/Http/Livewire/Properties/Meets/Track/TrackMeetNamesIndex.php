<?php

namespace App\Http\Livewire\Properties\Meets\Track;

use App\Models\Properties\Meets\Track\MeetName;
use Illuminate\Support\Facades\Route;
use Livewire\Component;
use Livewire\WithPagination;

class TrackMeetNamesIndex extends Component
{
    use WithPagination;

    public $search = '';
    public $sortField = 'name';
    public $sortDirection = 'asc';
    public $meetName = '';
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
        'refreshMeetNames'
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
        session()->flash('success', 'Meet Name Added');
    }

    public function recordUpdated()
    {
        session()->flash('success', 'Meet Name Updated');
    }

    public function confirmDelete(MeetName $meetName)
    {
        $this->meetName = $meetName;
        $this->showConfirmModal = true;
    }

    public function destroy(MeetName $meetName)
    {
        $this->meetName->delete();
        $this->showConfirmModal = false;
        session()->flash('success', 'Meet Name Deleted Successfully');
    }

    public function cancel()
    {
        $this->showFormModal = false;
        $this->editing = false;

        $this->emit('cancelCreate');
    }

    public function editRecord(MeetName $meetName)
    {
        $this->showFormModal = true;
        $this->editing = true;
        $this->emit('editMeetName', $meetName->id);
    }

    public function render()
    {
        return view('livewire.properties.meets.track.track-meet-names-index', [
            'meetNames' => MeetName::query()
                ->where('name', 'like', '%' . $this->search . '%')
                ->orderBy($this->sortField, $this->sortDirection)
                ->orderBy('name')
                ->paginate(25)
        ]);
    }
}
