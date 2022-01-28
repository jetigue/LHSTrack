<?php

namespace Database\Factories\Properties\Events\Track;

use App\Models\Properties\Events\Track\TrackEventType;
use Illuminate\Database\Eloquent\Factories\Factory;

class TrackEventTypeFactory extends Factory
{
    protected $model = TrackEventType::class;
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
