<?php

namespace App\Http\Livewire\Properties\Meets\Track;

use App\Models\Properties\Meets\Track\Season;
use Livewire\Component;

class TrackSeasonForm extends Component
{
    public $season = null;

    public $name;

    protected $listeners = [
        'cancelCreate' => 'resetForm',
        'submitCreate' => 'submitForm',
        'editSeason',
    ];

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function editSeason(Season $season)
    {
        $this->season = $season;
        $this->name = $this->season->name;
    }

    public function rules()
    {
        return [
            'name' => 'required|string|max:50',
        ];
    }

    public function submitForm()
    {
        $this->validate();

        $season = [
            'name' => $this->name,
        ];

        if ($this->season) {
            Season::find($this->season->id)->update($season);
            $this->emit('recordUpdated');
        } else {
            Season::create($season);
            $this->emit('recordAdded');
        }
        $this->resetForm();
        $this->emit('hideFormModal');
    }

    public function resetForm()
    {
        $this->reset(['name']);
    }

    public function render()
    {
        return view('livewire.properties.meets.track.track-season-form');
    }
}
