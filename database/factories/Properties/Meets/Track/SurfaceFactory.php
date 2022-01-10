<?php

namespace Database\Factories\Properties\Meets\Track;

use App\Models\Properties\Meets\Track\Surface;
use Illuminate\Database\Eloquent\Factories\Factory;

class SurfaceFactory extends Factory
{
    protected $model = Surface::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->word
        ];
    }
}
