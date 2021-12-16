<?php

namespace App\Http\Livewire;

use App\Models\Communication\TeamAnnouncement;
use Carbon\Carbon;
use Livewire\Component;

class Welcome extends Component
{
    public function render()
    {
        return view('livewire.welcome');
    }
}
