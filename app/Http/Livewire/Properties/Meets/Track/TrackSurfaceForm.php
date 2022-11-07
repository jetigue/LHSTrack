<?php

namespace App\Http\Livewire\Properties\Meets\Track;

use App\Models\Properties\Meets\Track\Surface;
use Livewire\Component;

class TrackSurfaceForm extends Component
{
    public $surface = null;

    public $name;

    protected $listeners = [
        'cancelCreate' => 'resetForm',
        'submitCreate' => 'submitForm',
        'editSurface',
    ];

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function editSurface(Surface $surface)
    {
        $this->surface = $surface;
        $this->name = $this->surface->name;
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

        $surface = [
            'name' => $this->name,
        ];

        if ($this->surface) {
            Surface::find($this->surface->id)->update($surface);
            $this->emit('recordUpdated');
        } else {
            $surface = Surface::create($surface);
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
        return view('livewire.properties.meets.track.track-surface-form');
    }
}
