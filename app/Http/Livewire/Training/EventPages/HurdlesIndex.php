<?php

namespace App\Http\Livewire\Training\EventPages;

use App\Models\Team\Links\HurdleLink;
use App\Models\Training\Workouts\HurdleWorkout;
use Illuminate\Support\Carbon;
use Livewire\Component;
use Livewire\WithPagination;

class HurdlesIndex extends Component
{
    use WithPagination;

    public $workout = '';

    public $link = '';

    public $editing = false;

    public $showFormModal = false;

    public $showConfirmModal = false;

    public $viewWorkout = false;

    public $timeFrame = '>=';

    public $whichWorkouts = 'Upcoming';

    public $addingEditingWorkout = false;

    public $addingEditingLink = false;

    protected $listeners = [
        'hideFormModal',
        'showFormModal',
        'confirmDelete',
        'recordAdded',
        'recordUpdated',
    ];

    public function showFormModal()
    {
        $this->addingEditingLink = false;
        $this->addingEditingWorkout = true;
        $this->showFormModal = true;
    }

    public function hideFormModal()
    {
        $this->addingEditingLink = false;
        $this->addingEditingWorkout = false;
        $this->showFormModal = false;
    }

    public function showWorkoutModal(): bool
    {
        return $this->viewWorkout = true;
    }

    public function hideWorkoutModal(): bool
    {
        return $this->viewWorkout = false;
    }

    public function updatedTimeFrame(): string
    {
        if ($this->timeFrame === '>=') {
            return $this->whichWorkouts = 'Upcoming';
        } elseif ($this->timeFrame === '<') {
            return $this->whichWorkouts = 'Past';
        }

        return $this->whichWorkouts = 'All';
    }

    public function addHurdleLink()
    {
        $this->addingEditingWorkout = false;
        $this->addingEditingLink = true;
        $this->showFormModal = true;
    }

    public function recordAdded()
    {
        session()->flash('success', 'Success!');
    }

    public function recordUpdated()
    {
        session()->flash('success', 'Updated!');
    }

    public function confirmWorkoutDelete(HurdleWorkout $workout)
    {
        $this->workout = $workout;
        $this->showConfirmModal = true;
    }

    public function confirmLinkDelete(HurdleLink $link)
    {
        $this->link = $link;
        $this->showConfirmModal = true;
    }

    public function destroyWorkout(HurdleWorkout $workout)
    {
        $this->workout->delete();
        $this->showConfirmModal = false;
        session()->flash('success', 'Workout Deleted Successfully');
    }

    public function destroyLink(HurdleLink $link)
    {
        $this->link->delete();
        $this->showConfirmModal = false;
        session()->flash('success', 'Link Deleted Successfully');
    }

    public function cancel()
    {
        $this->showFormModal = false;
        $this->addingEditingLink = false;
        $this->addingEditingWorkout = false;
        $this->editing = false;

        $this->emit('cancelCreate');
    }

    public function editWorkout(HurdleWorkout $workout)
    {
        $this->addingEditingLink = false;
        $this->addingEditingWorkout = true;
        $this->showFormModal = true;
        $this->editing = true;
        $this->emit('editWorkout', $workout->id);
    }

    public function editLink(HurdleLink $link)
    {
        $this->addingEditingWorkout = false;
        $this->addingEditingLink = true;
        $this->showFormModal = true;
        $this->editing = true;
        $this->emit('editLink', $link->id);
    }

    public function render()
    {
        return view('livewire.training.event-pages.hurdles-index', [

            'workouts' => HurdleWorkout::query()
                ->when($this->timeFrame, function ($query, $timeFrame) {
                    return $query->where('workout_date', $timeFrame, Carbon::now());
                })
                ->orderBy('workout_date')
                ->paginate(25),

            'hurdleLinks' => HurdleLink::all(),
        ]);
    }
}
