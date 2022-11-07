<?php

namespace App\Http\Livewire\Properties\Races;

use App\Models\Properties\Races\Title;
use Livewire\Component;
use function view;

class TitleForm extends Component
{
    public $title = null;

    public $name;

    protected $listeners = [
        'cancelCreate' => 'resetForm',
        'submitCreate' => 'submitForm',
        'editTitle',
    ];

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function editTitle(Title $title)
    {
        $this->title = $title;
        $this->name = $this->title->name;
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

        $title = [
            'name' => $this->name,
        ];

        if ($this->title) {
            Title::find($this->title->id)->update($title);
            $this->emit('recordUpdated');
        } else {
            Title::create($title);
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
        return view('livewire.properties.races.title-form');
    }
}
