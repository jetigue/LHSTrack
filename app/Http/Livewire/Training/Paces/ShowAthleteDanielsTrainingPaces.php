<?php

namespace App\Http\Livewire\Training\Paces;

use App\Models\Athletes\Athlete;
use Livewire\Component;
use function view;

class ShowAthleteDanielsTrainingPaces extends Component
{
    public Athlete $athlete;

    public float $percentVO2;

    public function mount($percentVO2)
    {
        $this->percentVO2 = $percentVO2;
    }

    public function render()
    {
        return view('livewire.training.paces.show-athlete-daniels-training-paces');
    }
}
