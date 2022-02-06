<?php

namespace App\Http\Livewire\TimeTrials;

use App\Models\Properties\Races\Gender;
use App\Models\TimeTrials\TrackTimeTrial;
use App\Models\Properties\Events\Track\TrackEvent;
use App\Models\TimeTrials\Results\Track\RunningEventResult;

use Livewire\Component;

class TrackTimeTrialRunningEventResultsIndex extends Component
{
    public TrackEvent $trackEvent;
    public TrackTimeTrial $timeTrial;

    public $result = '';
    public $editing = false;
    public $showFormModal = false;
    public $showConfirmModal = false;
    public $gender;

    protected $listeners = [
        'hideFormModal',
        'showFormModal',
        'confirmDelete',
        'recordAdded',
        'recordUpdated'
    ];

    public function mount()
    {
        if (str_contains(url()->current(), 'boys'))
        {
            $this->gender = Gender::firstWhere('id', 1);
        } else {
            $this->gender = Gender::firstWhere('id', 2);
        }
    }

    public function showFormModal() { $this->showFormModal = true; }
    public function hideFormModal() { $this->showFormModal = false; }

    public function recordAdded()
    {
        session()->flash('success', 'Result Added');
    }

    public function recordUpdated()
    {
        session()->flash('success', 'Result Updated');
    }

    public function confirmDelete(RunningEventResult $result)
    {
        $this->result = $result;
        $this->showConfirmModal = true;
    }

    public function destroy(RunningEventResult $result)
    {
        $this->result->delete();
        $this->showConfirmModal = false;
        session()->flash('success', 'Result Deleted Successfully');
    }

    public function cancel()
    {
        $this->showFormModal = false;
        $this->editing = false;

        $this->emit('cancelCreate');
    }

    public function editRecord(RunningEventResult $result)
    {
        $this->showFormModal = true;
        $this->editing = true;
        $this->emit('editResult', $result->id);
    }

    public function render()
    {
        return view('livewire.time-trials.track-time-trial-running-event-results-index', [
            'results' => RunningEventResult::with('timeTrial', 'athlete', 'trackEvent')
                ->where('track_time_trial_id', $this->timeTrial->id)
                ->where('track_event_id', $this->trackEvent->id)
                ->orderBy('place')
                ->get(),

            'boysEvents' => $this->timeTrial->boysTrackEvents
                ->sortBy('distance_in_meters')
                ->sortBy('eventSubType.track_event_type_id'),

            'girlsEvents' => $this->timeTrial->girlsTrackEvents
                ->sortBy('distance_in_meters')
                ->sortBy('eventSubType.track_event_type_id')
        ]);
    }
}
