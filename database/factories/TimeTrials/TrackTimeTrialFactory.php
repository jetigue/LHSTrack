<?php

namespace Database\Factories\TimeTrials;

use App\Models\Properties\Meets\Timing;
use App\Models\Properties\Meets\Track\Venue;
use App\Models\TimeTrials\TrackTimeTrial;
use Illuminate\Database\Eloquent\Factories\Factory;

class TrackTimeTrialFactory extends Factory
{
    protected $model = TrackTimeTrial::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->sentence(4),
            'trial_date' => $this->faker->dateTimeThisYear($max = 'now', $timezone = null),
            'track_venue_id' => Venue::all()->random()->id,
            'timing_method_id' => Timing::all()->random()->id,
        ];
    }
}
