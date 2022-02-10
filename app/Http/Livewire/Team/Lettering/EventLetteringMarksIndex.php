<?php

namespace App\Http\Livewire\Team\Lettering;

use App\Models\Properties\Races\Gender;
use App\Models\Team\FieldEventLetteringMark;
use App\Models\Team\RunningEventLetteringTime;
use Livewire\Component;

class EventLetteringMarksIndex extends Component
{
    public Gender $gender;
    public $runningStandard = '';
    public $fieldEventStandard = '';
    public $editing = false;
    public $showFormModal = false;
    public $showConfirmModal = false;
    public $addingRunningEvent = true;
    public $addingFieldEvent = false;

    protected $listeners = [
        'hideFormModal',
        'showFormModal',
        'confirmDelete',
        'recordAdded',
        'recordUpdated'
    ];

    public function showFormModal() { $this->showFormModal = true; }
    public function hideFormModal() { $this->showFormModal = false; }

    Public function addRunningEventStandard()
    {
        $this->addingRunningEvent = true;
        $this->addingFieldEvent = false;
        $this->showFormModal = true;
    }

    Public function addFieldEventStandard()
    {
        $this->addingRunningEvent = false;
        $this->addingFieldEvent = true;
        $this->showFormModal = true;
    }

    public function recordAdded()
    {
        session()->flash('success', 'Standard Added');
    }

    public function recordUpdated()
    {
        session()->flash('success', 'Standard Updated');
    }

    public function confirmDeleteRunningStandard(RunningEventLetteringTime $runningStandard)
    {
        $this->runningStandard = $runningStandard;
        $this->showConfirmModal = true;
    }

    public function confirmDeleteFieldStandard(FieldEventLetteringMark $fieldEventStandard)
    {
        $this->fieldEventStandard = $fieldEventStandard;
        $this->showConfirmModal = true;
    }

    public function destroyRunningEventTime(RunningEventLetteringTime $runningStandard)
    {
        $this->runningStandard->delete();
        $this->showConfirmModal = false;
        session()->flash('success', 'Standard Deleted Successfully');
    }

    public function destroyFieldEventMark(FieldEventLetteringMark $fieldEventStandard)
    {
        $this->fieldEventStandard->delete();
        $this->showConfirmModal = false;
        session()->flash('success', 'Standard Deleted Successfully');
    }

    public function cancel()
    {
        $this->showFormModal = false;
        $this->editing = false;

        $this->emit('cancelCreate');
    }

    public function editRunningStandard(RunningEventLetteringTime $runningStandard)
    {
        $this->addingFieldEvent = false;
        $this->addingRunningEvent = true;
        $this->showFormModal = true;
        $this->editing = true;
        $this->emit('editRunningStandard', $runningStandard->id);
    }

    public function editFieldEventStandard(FieldEventLetteringMark $fieldEventStandard)
    {
        $this->editing = true;
        $this->addingFieldEvent = true;
        $this->addingRunningEvent = false;
        $this->showFormModal = true;

        $this->emit('editMark', $fieldEventStandard->id);
    }

    public function render()
    {
        return view('livewire.team.lettering.event-lettering-marks-index', [
            'runningStandards' => RunningEventLetteringTime::with('trackEvent', 'gender')
                ->where('gender_id', $this->gender->id)
                ->get(),

            'fieldEventStandards' => FieldEventLetteringMark::with('trackEvent', 'gender')
                ->where('gender_id', $this->gender->id)
                ->get()
        ]);
    }
}
