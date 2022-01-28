<?php

namespace Database\Factories\Properties\Events\Track;

use App\Models\Properties\Events\Track\TrackEvent;
use App\Models\Properties\Events\Track\TrackEventSubtype;
use Illuminate\Database\Eloquent\Factories\Factory;

class TrackEventFactory extends Factory
{
    protected $model = TrackEvent::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->word,
            'distance_in_meters' => $this->faker->numberBetween([100, 3200]),
            'track_event_subtype_id' => TrackEventSubtype::all()->random()->id,
        ];
    }
}
