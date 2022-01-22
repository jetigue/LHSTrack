<?php

namespace App\Http\Livewire\Properties\Events;

use App\Models\Properties\Events\EventCategory;
use Livewire\Component;

class EventCategoryForm extends Component
{
    public $category = null;
    public $name;

    protected $listeners = [
        'cancelCreate' => 'resetForm',
        'submitCreate' => 'submitForm',
        'editCategory'
    ];

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function editCategory(EventCategory $category)
    {
        $this->category = $category;
        $this->name = $this->category->name;
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

        $category = [
            'name' => $this->name,
        ];

        if ($this->category) {
            EventCategory::find($this->category->id)->update($category);
            $this->emit('recordUpdated');
        } else {
            EventCategory::create($category);
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
        return view('livewire.properties.events.event-category-form');
    }
}
