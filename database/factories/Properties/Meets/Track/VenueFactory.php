<?php

namespace Database\Factories\Properties\Meets\Track;

use App\Models\Properties\Meets\Track\Surface;
use App\Models\Properties\Meets\Track\Venue;
use Illuminate\Database\Eloquent\Factories\Factory;

class VenueFactory extends Factory
{
    protected $model = Venue::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->lastName.' '.'Stadium',
            'track_surface_id' => Surface::all()->random()->id,
        ];
    }
}
