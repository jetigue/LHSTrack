<?php

namespace Database\Seeders;

use App\Models\Meets\TrackMeet;
use App\Models\Properties\Meets\Host;
use App\Models\Properties\Meets\Timing;
use App\Models\Properties\Meets\Track\MeetName;
use App\Models\Properties\Meets\Track\Season;
use App\Models\Properties\Meets\Track\Surface;
use App\Models\Properties\Meets\Track\Venue;
use Illuminate\Database\Seeder;

class TrackMeetSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Season::factory(2)->create();
        Timing::factory(2)->create();
        Host::factory(20)->create();
        MeetName::factory(20)->create();
        Surface::factory(3)->create();
        Venue::factory(20)->create();
        TrackMeet::factory(20)->create();
    }
}
