<?php

namespace Database\Factories\Meets;

use App\Models\Meets\TrackMeet;
use App\Models\Properties\Meets\Host;
use App\Models\Properties\Meets\Timing;
use App\Models\Properties\Meets\Track\MeetName;
use App\Models\Properties\Meets\Track\Season;
use App\Models\Properties\Meets\Track\Venue;
use Illuminate\Database\Eloquent\Factories\Factory;

class TrackMeetFactory extends Factory
{
    protected $model = TrackMeet::class;
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'track_meet_name_id' => MeetName::all()->random()->id,
            'meet_date' => $this->faker->date($format = 'Y-m-d'),
            'track_season_id' => Season::all()->random()->id,
            'host_id' => Host::all()->random()->id,
            'track_venue_id' => Venue::all()->random()->id,
            'timing_method_id' => Timing::all()->random()->id,
            'meet_page_url' => $this->faker->url
        ];
    }
}
