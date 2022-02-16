<?php

namespace App\Http\Livewire\Training\EventPages;

use App\Models\Team\Links\HurdleLink;
use Auth;
use Livewire\Component;

class HurdleLinkForm extends Component
{
    public $link = null;
    public $text;
    public $url;

    protected $listeners = [
        'cancelCreate' => 'resetForm',
        'submitCreate' => 'submitForm',
        'editLink'
    ];

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function rules()
    {
        return [
            'text' => 'required|string',
            'url' => 'required|url',
        ];
    }

    public function editLink(HurdleLink $link)
    {
        $this->link = $link;
        $this->text = $this->link->text;
        $this->url = $this->link->url;
    }

    public function submitForm()
    {
        $this->validate();

        $link = [
            'text' => $this->text,
            'url' => $this->url,
            'user_id' => Auth::user()->id
        ];

        if ($this->link) {
            HurdleLink::find($this->link->id)->update($link);
        } else {
            HurdleLink::create($link);
        }

        $this->emit('hideFormModal');
        $this->resetForm();
    }

    public function resetForm()
    {
        $this->reset([
            'text',
            'url',
        ]);
    }

    public function render()
    {
        return view('livewire.training.event-pages.hurdle-link-form');
    }
}
