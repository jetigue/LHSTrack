<?php

namespace Database\Factories\Athletes;

use App\Models\Athletes\Athlete;
use Illuminate\Database\Eloquent\Factories\Factory;

class AthleteFactory extends Factory
{

    protected $model = Athlete::class;

    public function definition(): array
    {
        return [
            'first_name' => $this->faker->firstName,
            'last_name'  => $this->faker->lastName,
            'sex'        => $this->faker->randomElement($array = ['m', 'f']),
            'grad_year'  => $this->faker->randomElement($array = [2021, 2022, 2023, 2024, 2025]),
            'dob'        => $this->faker->date($format = 'Y-m-d', $max = '2006-01-01'),
            'status'     => $this->faker->randomElement($array = ['a', 'i']),
        ];
    }
}
