<?php

namespace Database\Factories\Properties\Races;

use Illuminate\Database\Eloquent\Factories\Factory;

class GenderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->word,
        ];
    }
}
