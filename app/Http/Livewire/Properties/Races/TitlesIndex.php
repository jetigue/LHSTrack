<?php

namespace App\Http\Livewire\Properties\Races;

use App\Models\Properties\Races\Title;
use Livewire\Component;
use function view;

class TitlesIndex extends Component
{
    public $title = '';

    public $editing = false;

    public $showFormModal = false;

    public $showConfirmModal = false;

    protected $listeners = [
        'hideFormModal',
        'showFormModal',
        'confirmDelete',
        'recordAdded',
        'recordUpdated',
    ];

    public function showFormModal()
    {
        $this->showFormModal = true;
    }

    public function hideFormModal()
    {
        $this->showFormModal = false;
    }

    public function recordAdded()
    {
        session()->flash('success', 'Title Added');
    }

    public function recordUpdated()
    {
        session()->flash('success', 'Title Updated');
    }

    public function confirmDelete(Title $titles)
    {
        $this->title = $titles;
        $this->showConfirmModal = true;
    }

    public function destroy(Title $titles)
    {
        $this->title->delete();
        $this->showConfirmModal = false;
        session()->flash('success', 'Title Deleted Successfully');
    }

    public function cancel()
    {
        $this->showFormModal = false;
        $this->editing = false;

        $this->emit('cancelCreate');
    }

    public function editRecord(Title $titles)
    {
        $this->showFormModal = true;
        $this->editing = true;
        $this->emit('editTitle', $titles->id);
    }

    public function render()
    {
        return view('livewire.properties.races.titles-index', [
            'titles' => Title::orderBy('name')->get(),
        ]);
    }
}
