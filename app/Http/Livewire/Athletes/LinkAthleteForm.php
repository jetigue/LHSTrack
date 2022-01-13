<?php

namespace App\Http\Livewire\Athletes;

use App\Models\Athletes\Athlete;
use App\Models\Users\User;
use Livewire\Component;

class LinkAthleteForm extends Component
{
    public $athlete = null;
    public $first_name;
    public $last_name;
    public $user_id;

    protected $listeners = [
        'linkAthlete' => 'editAthlete',
        'cancelLink' => '$refresh',
        'linkSubmitted'
    ];

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function editAthlete(Athlete $athlete)
    {
        $this->athlete = $athlete;
        $this->first_name = $this->athlete->first_name;
        $this->last_name = $this->athlete->last_name;
        $this->user_id = $this->athlete->user_id;
    }

    public function rules()
    {
        return [
            'user_id' => 'integer',
        ];
    }

    public function linkSubmitted()
    {
        $this->validate();

        $athlete = [
            'user_id' => $this->user_id,
        ];

        if ($this->athlete) {
            Athlete::find($this->athlete->id)->update($athlete);
            User::where('id', $this->user_id)->update(['user_role_id' => 2]);
            $this->emit('recordUpdated');
        }

        $this->resetForm();
        $this->emit('hideLinkModal');
    }

    public function resetForm()
    {
        $this->reset(['first_name', 'last_name', 'user_id']);
    }

    public function render()
    {
        return view('livewire.athletes.link-athlete-form', [
            'users' => User::orderBy('name')->get()
        ]);
    }
}
