<?php

namespace App\View\Components;

use App\Models\Athletes\Athlete;
use Illuminate\View\Component;

class TrainingPace extends Component
{
    public Athlete $athlete;

    public float $distance;

    public float $percentVO2;

    public float $a = 29.54;

    public float $b = 5.000663;

    public float $c = 0.007546;

    public float $x;

    public float $seconds;

    public string $pace;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($athlete, $distance, $percentVO2)
    {
        $this->distance = $distance;
        $this->percentVO2 = $percentVO2;
        $this->athlete = $athlete;
        $this->x = $this->percentVO2 * $this->athlete->bestPerformance->vdot;
        $this->seconds = 1 / ($this->a + $this->b * $this->x - $this->c * ($this->x ** 2)) * $this->distance * 60;
        $this->pace = ltrim($this->seconds > 3659 ? gmdate('h:i:s', $this->seconds) : (($this->seconds < 3659 and $this->seconds > 59) ? gmdate('i:s', $this->seconds) : gmdate(':s', $this->seconds)), 0);
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.training-pace');
    }
}
