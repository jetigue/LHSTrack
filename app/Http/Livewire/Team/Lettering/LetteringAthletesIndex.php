<?php

namespace App\Http\Livewire\Team\Lettering;

use App\Models\Athletes\Athlete;
use Livewire\Component;
use Livewire\WithPagination;

class LetteringAthletesIndex extends Component
{
    use WithPagination;

    public $search = '';
    public $sortField = 'last_name';
    public $sortDirection = 'asc';
    public $athlete = '';
    public $route = '';
    public $gender = '';
    public $grade = '';


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

    public function clearSearch()
    {
        $this->reset('search');
    }

    public function render()
    {
        return view('livewire.team.lettering.lettering-athletes-index', [
            'athletes' => Athlete::with('user')
                ->where('status', '=', 'a')
                ->orderBy($this->sortField, $this->sortDirection)
                ->when($this->gender, function ($query, $gender) {
                    return $query->where('sex', $gender);
                    })
                ->when($this->grade, function ($query, $grade) {
                    return $query->where('grad_year', $grade);
                    })
                ->whereLike(['last_name', 'first_name'], $this->search ?? '')
                ->orderBy('last_name')
                ->paginate(25),
        ]);
    }
}
