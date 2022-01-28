<?php

namespace Database\Factories\Properties\Races;

use App\Models\Properties\Races\Gender;
use App\Models\Properties\Races\Level;
use Illuminate\Database\Eloquent\Factories\Factory;

class DivisionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'gender_id' => Gender::all()->random()->id,
            'level_id' => Level::all()->random()->id,
        ];
    }
}
