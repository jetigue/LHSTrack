<?php

namespace App\Http\Livewire\Communication;

use App\Models\Communication\TeamAnnouncement;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Mews\Purifier\Facades\Purifier;

class TeamAnnouncementsForm extends Component
{
    public $announcement = null;

    public $title;

    public $begin_date_for_editing;

    public $end_date_for_editing;

    public $body;

    protected $listeners = [
        'cancelCreate' => 'resetForm',
        'submitCreate' => 'submitForm',
        'editAnnouncement' => 'edit',
    ];

    public function mount()
    {
        $this->content = $this->body;
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function rules()
    {
        return [
            'title' => 'required',
            'begin_date_for_editing' => 'required|date',
            'end_date_for_editing' => 'required|date|after:begin_date',
            'body' => 'required',
        ];
    }

    public function edit(TeamAnnouncement $announcement)
    {
        $this->announcement = $announcement;
        $this->title = $this->announcement->title;
        $this->begin_date_for_editing = $this->announcement->begin_date_for_editing;
        $this->end_date_for_editing = $this->announcement->end_date_for_editing;
        $this->body = $this->announcement->body;
    }

    public function submitForm()
    {
        $this->validate();

        $announcement = [
            'begin_date' => $this->begin_date_for_editing,
            'end_date' => $this->end_date_for_editing,
            'title' => $this->title,
            'body' => Purifier::clean($this->body),
            'user_id' => Auth::user()->id,
        ];

        if ($this->announcement) {
            TeamAnnouncement::find($this->announcement->id)->update($announcement);
        } else {
            $announcement = TeamAnnouncement::create($announcement);
        }
        $this->resetForm();
        $this->emit('hideModal');
    }

    public function resetForm()
    {
        $this->reset([
            'begin_date_for_editing',
            'end_date_for_editing',
            'title',
            'body',
        ]);
    }

    public function render()
    {
        return view('livewire.communication.team-announcements-form');
    }
}
