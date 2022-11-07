<?php

namespace App\Traits;

trait TrainingPacesTrait
{
    protected float $a = 29.54;

    protected float $b = 5.000663;

    protected float $c = 0.007546;

    protected float $percentVO2 = .74;

    public function getEasyPaceAttribute(): float
    {
        return 29.54;
    }
}
