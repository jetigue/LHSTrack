<?php

namespace App\Http\Livewire\Properties\Meets;

use App\Models\Properties\Meets\Host;
use Livewire\Component;

class MeetHostForm extends Component
{
    public $meetHost = null;
    public $name;

    protected $listeners = [
        'cancelCreate' => 'resetForm',
        'submitCreate' => 'submitForm',
        'editMeetHost'
    ];

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function editMeetHost(Host $meetHost)
    {
        $this->meetHost = $meetHost;
        $this->name = $this->meetHost->name;
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

        $meetHost = [
            'name' => $this->name,
        ];

        if ($this->meetHost) {
            Host::find($this->meetHost->id)->update($meetHost);
            $this->emit('recordUpdated');
        } else {
            $meetHost = Host::create($meetHost);
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
        return view('livewire.properties.meets.meet-host-form');
    }
}
