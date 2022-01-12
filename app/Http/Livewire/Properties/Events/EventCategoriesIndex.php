<?php

namespace App\Http\Livewire\Properties\Events;

use App\Models\Properties\Events\Category;
use Livewire\Component;

class EventCategoriesIndex extends Component
{
    public $category = '';
    public $editing = false;
    public $showFormModal = false;
    public $showConfirmModal = false;

    protected $listeners = [
        'hideFormModal',
        'showFormModal',
        'confirmDelete',
        'recordAdded',
        'recordUpdated'
    ];

    public function showFormModal() { $this->showFormModal = true; }
    public function hideFormModal() { $this->showFormModal = false; }

    public function recordAdded()
    {
        session()->flash('success', 'Category Added');
    }

    public function recordUpdated()
    {
        session()->flash('success', 'Category Updated');
    }

    public function confirmDelete(Category $category)
    {
        $this->category = $category;
        $this->showConfirmModal = true;
    }

    public function destroy(Category $category)
    {
        $this->category->delete();
        $this->showConfirmModal = false;
        session()->flash('success', 'Category Deleted Successfully');
    }

    public function cancel()
    {
        $this->showFormModal = false;
        $this->editing = false;

        $this->emit('cancelCreate');
    }

    public function editRecord(Category $category)
    {
        $this->showFormModal = true;
        $this->editing = true;
        $this->emit('editCategory', $category->id);
    }

    public function render()
    {
        return view('livewire.properties.events.event-categories-index', [
            'categories' => Category::all()
        ]);
    }
}
