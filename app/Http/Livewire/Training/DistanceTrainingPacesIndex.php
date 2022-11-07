<?php

namespace App\Http\Livewire\Training;

use App\Models\Athletes\Athlete;
use Carbon\Carbon;
use Livewire\Component;

class DistanceTrainingPacesIndex extends Component
{
    public $season;

    public $percentVO2 = .67;

    public $filteredSex = false;

    public $sex;

    public $units = 'meters';

    public function mount()
    {
        $this->season = Carbon::now()->year;
    }

    public function updatedSex(): bool
    {
        if ($this->sex !== '') {
            $this->filteredSex = true;

            return $this->sex;
        }

        return $this->filteredSex = false;
    }

    public function clearFilters()
    {
        $this->filteredSex = false;
        $this->sex = '';
        $this->percentVO2 = .67;
        $this->unit = 'meters';
    }

    public function render()
    {
        return view('livewire.training.distance-training-paces-index', [

            'athletes' => Athlete::with('runningEventResults')
            ->whereHas('runningEventResults.teamResult.trackMeet', function ($query) {
                $query->whereYear('meet_date', $this->season);
            })
            ->whereHas('runningEventResults', function ($query) {
                $query->whereNotNull('vdot');
            })
            ->get()->sortByDesc('bestPerformance.vdot'),

        ]);
    }
}
