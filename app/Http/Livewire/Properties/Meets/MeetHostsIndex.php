<?php

namespace App\Http\Livewire\Properties\Meets;

use App\Models\Properties\Meets\Host;
use Livewire\Component;
use Livewire\WithPagination;

class MeetHostsIndex extends Component
{
    use WithPagination;

    public $search = '';
    public $sortField = 'name';
    public $sortDirection = 'asc';
    public $host = '';
    public $editing = false;
    public $showFormModal = false;
    public $showConfirmModal = false;

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
        'recordUpdated'
    ];

    public function showFormModal() { $this->showFormModal = true; }
    public function hideFormModal() { $this->showFormModal = false; }

    public function clearSearch()
    {
        $this->reset('search');
    }

    public function recordAdded()
    {
        session()->flash('success', 'Meet Host Added');
    }

    public function recordUpdated()
    {
        session()->flash('success', 'Meet Host Updated');
    }

    public function confirmDelete(Host $host)
    {
        $this->host = $host;
        $this->showConfirmModal = true;
    }

    public function destroy(Host $host)
    {
        $this->host->delete();
        $this->showConfirmModal = false;
        session()->flash('success', 'Meet Host Deleted Successfully');
    }

    public function cancel()
    {
        $this->showFormModal = false;
        $this->editing = false;

        $this->emit('cancelCreate');
    }

    public function editRecord(Host $host)
    {
        $this->showFormModal = true;
        $this->editing = true;
        $this->emit('editMeetHost', $host->id);
    }

    public function render()
    {
        return view('livewire.properties.meets.meet-hosts-index', [
            'meetHosts' => Host::query()
                ->where('name', 'like', '%' . $this->search . '%')
                ->orderBy($this->sortField, $this->sortDirection)
                ->orderBy('name')
                ->paginate(25)
        ]);
    }
}
