<?php

namespace Database\Factories\Properties\Meets;

use App\Models\Properties\Meets\Timing;
use Illuminate\Database\Eloquent\Factories\Factory;

class TimingFactory extends Factory
{
    protected $model = Timing::class;

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
