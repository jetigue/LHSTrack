<?php

namespace Database\Factories\Properties\Meets;

use App\Models\Properties\Meets\Host;
use Illuminate\Database\Eloquent\Factories\Factory;

class HostFactory extends Factory
{
    protected $model = Host::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->lastName . ' ' . 'High School',
        ];
    }
}
