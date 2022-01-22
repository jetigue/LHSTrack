<?php

namespace Database\Factories\Properties\Events;

use App\Models\Properties\Events\EventCategory;
use App\Models\Properties\Events\TrackEvent;
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
            'event_category_id' => EventCategory::all()->random()->id,
        ];
    }
}
