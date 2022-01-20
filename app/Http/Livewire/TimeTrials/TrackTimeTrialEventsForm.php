<?php

namespace App\Http\Livewire\TimeTrials;

use App\Models\Properties\Events\Category;
use App\Models\Properties\Events\TrackEvent;
use Illuminate\Support\Str;
use Livewire\Component;

class TrackTimeTrialEventsForm extends Component
{
    public $timeTrial;
    public $selectGroup;
    public $selected = [];

    public function mount($timeTrial)
    {
        $this->selected = $timeTrial->trackEvents()
            ->whereTrackTimeTrialId($this->timeTrial->id)
            ->pluck('id');
    }

//    public function updated($key, $value)
//    {
//        $explode = Str::of($key)->explode('.');
//        if ($explode[0] === 'selectGroup' && is_numeric($value)) {
//            $categoryIds = TrackEvent::where('category_id', $value)->pluck('id')->map(fn($id) => (string)$id)->toArray();
//            $this->selected = array_values(array_unique(array_merge_recursive($this->selected, $categoryIds)));
//        } elseif ($explode[0] === 'selectGroup' && empty($value)) {
//            $categoryIds = TrackEvent::where('category_id', $explode[1])->pluck('id')->map(fn($id) => (string)$id)->toArray();
//            $this->selected = array_merge(array_diff($this->selected, $categoryIds));
//        }
//    }

    public function rules()
    {
        return [
            'selected' => 'array|numeric',
        ];
    }

public function save()
{
    $this->timeTrial->trackEvents()->sync($this->selected);

    $this->reset(['selected', 'selectGroup']);
}

    public function render()
    {
        return view('livewire.time-trials.track-time-trial-events-form', [
            'eventCategories' => Category::orderBy('name')->get(),
//            'events' => TrackEvent::with('category')->orderBy('event_category_id')->get()
        ]);
    }
}
