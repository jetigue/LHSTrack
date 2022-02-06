<?php

namespace Database\Factories\Properties\Races;

use App\Models\Properties\Races\Gender;
use Illuminate\Database\Eloquent\Factories\Factory;

class GenderFactory extends Factory
{
    protected $model = Gender::class;
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
