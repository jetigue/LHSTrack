<?php

namespace Database\Factories\Properties\Events;

use App\Models\Properties\Events\Category;
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
            'event_category_id' => Category::all()->random()->id,
        ];
    }
}
