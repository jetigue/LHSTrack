<?php

namespace App\Http\Livewire\Athletes;

use App\Exports\AthletesExport;
use App\Models\Athletes\Athlete;
use App\Models\Properties\Events\Track\TrackEventSubtype;
use Illuminate\Support\Facades\Route;
use Livewire\Component;
use Livewire\WithPagination;
use Maatwebsite\Excel\Facades\Excel;

class AthletesIndex extends Component
{
    use WithPagination;

    public $search = '';
    public $sortField = 'last_name';
    public $sortDirection = 'asc';
    public $athlete = '';
    public $editing = false;
    public $showFormModal = false;
    public $showConfirmModal = false;
    public $showLinkModal = false;
    public $clearFilters;
    public $status = '';
    public $event = '';
    public $gender = '';
    public $grade = '';
    public $user = '';
    public $route;

    protected $queryString = ['status', 'sortField', 'sortDirection', 'search', 'event', 'grade', 'gender', 'user'];

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
        'refreshAthletes',
        'hideLinkModal'
    ];

    public function mount()
    {
        $this->route = Route::currentRouteName();
    }

    public function showFormModal() { $this->showFormModal = true; }
    public function hideFormModal() { $this->showFormModal = false; }
    public function hideLinkModal() { $this->showLinkModal = false; }

    public function clearSearch()
    {
        $this->reset('search');
    }

    public function recordAdded()
    {
        session()->flash('success', 'Athlete Added');
    }

    public function recordUpdated()
    {
        session()->flash('success', 'Athlete Updated');
    }

    public function refreshAthletes()
    {
        session()->flash('success', 'Athletes Imported Successfully');

        $this->render();

    }

    public function confirmDelete(Athlete $athlete)
    {
        $this->athlete = $athlete;
        $this->showConfirmModal = true;
    }

    public function destroy(Athlete $athlete)
    {
        $this->athlete->delete();
        $this->showConfirmModal = false;
        session()->flash('success', 'Athlete Deleted Successfully');
    }

    public function cancel()
    {
        $this->showFormModal = false;
        $this->showLinkModal = false;
        $this->editing = false;

        $this->emit('cancelCreate');
        $this->emit('cancelLink');
    }

    public function editRecord(Athlete $athlete)
    {
        $this->showFormModal = true;
        $this->editing = true;
        $this->emit('editAthlete', $athlete->id);
    }

    public function linkAthlete(Athlete $athlete)
    {
        $this->showLinkModal = true;
        $this->emit('linkAthlete', $athlete->id);
    }

    public function clearFilters()
    {
        $this->gender = '';
        $this->status = '';
        $this->event = '';
        $this->grade = '';
        $this->user = '';
    }

    public function export(): \Symfony\Component\HttpFoundation\BinaryFileResponse
    {
        return Excel::download(new AthletesExport, 'athletes.xlsx');
    }

    public function render()
    {
        return view('livewire.athletes.athletes-index', [
            'athletes' => Athlete::with('user', 'primaryTrackEvent')
                ->orderBy($this->sortField, $this->sortDirection)
                ->when($this->gender, function ($query, $gender) {
                    return $query->where('sex', $gender);
                    })
                ->when($this->grade, function ($query, $grade) {
                    return $query->where('grad_year', $grade);
                    })
                ->when($this->status, function ($query, $status) {
                    return $query->where('status', $status);
                    })
                ->when($this->event, function ($query, $event) {
                    return $query->where('event_category_id', $event);
                    })
                ->when($this->user == "true", function ($query) {
                    return $query->whereNotNull('user_id');
                    })
                ->whereLike(['last_name', 'first_name'], $this->search ?? '')
                ->orderBy('last_name')
                ->paginate(25),

            'eventCategories' => TrackEventSubtype::all()
        ]);
    }
}
