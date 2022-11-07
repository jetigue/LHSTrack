<?php

namespace Database\Factories\Properties\Events\Track;

use App\Models\Properties\Events\Track\TrackEventSubtype;
use App\Models\Properties\Events\Track\TrackEventType;
use Illuminate\Database\Eloquent\Factories\Factory;

class TrackEventSubtypeFactory extends Factory
{
    protected $model = TrackEventSubtype::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->word,
            'track_event_type_id' => TrackEventType::all()->random()->id,
        ];
    }
}
