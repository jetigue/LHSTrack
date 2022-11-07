<?php

namespace App\Http\Livewire\Properties\Meets\Track;

use App\Models\Properties\Meets\Track\MeetName;
use Livewire\Component;

class TrackMeetNameForm extends Component
{
    public $meetName = null;

    public $name;

    protected $listeners = [
        'cancelCreate' => 'resetForm',
        'submitCreate' => 'submitForm',
        'editMeetName',
    ];

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function editMeetName(MeetName $meetName)
    {
        $this->meetName = $meetName;
        $this->name = $this->meetName->name;
    }

    public function rules()
    {
        return [
            'name' => 'required|string|max:150',
        ];
    }

    public function submitForm()
    {
        $this->validate();

        $meetName = [
            'name' => $this->name,
        ];

        if ($this->meetName) {
            MeetName::find($this->meetName->id)->update($meetName);
            $this->emit('recordUpdated');
        } else {
            $meetName = MeetName::create($meetName);
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
        return view('livewire.properties.meets.track.track-meet-name-form');
    }
}
