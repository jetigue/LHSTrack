<?php

namespace Tests\Feature\TrackMeets;

use App\Models\Meets\TrackMeet;
use App\Models\Properties\Events\Track\TrackEvent;
use App\Models\Properties\Events\Track\TrackEventSubtype;
use App\Models\Properties\Meets\Host;
use App\Models\Properties\Meets\Timing;
use App\Models\Properties\Meets\Track\MeetName;
use App\Models\Properties\Meets\Track\Season;
use App\Models\Properties\Meets\Track\Surface;
use App\Models\Properties\Meets\Track\Venue;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TrackEventsTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function an_event_can_be_competed_at_any_track_meet()
    {
        $this->withoutExceptionHandling();

        $season = Season::factory()->create();
        $surface = Surface::factory()->create();
        $venue = Venue::factory()->create(['track_surface_id' => $surface->id]);
        $host = Host::factory()->create();
        $name = MeetName::factory()->create();
        $timing = Timing::factory()->create();

        $trackMeet = TrackMeet::factory()->create([
            'track_season_id' => $season->id,
            'track_venue_id' => $venue->id,
            'track_meet_name_id' => $name->id,
            'host_id' => $host->id,
            'timing_method_id' => $timing->id,
        ]);

        $category = TrackEventSubtype::factory()->create();
        $trackEvent = TrackEvent::factory()->create(['event_category_id' => $category->id]);

        $trackEvent->competedAt($trackMeet);

        $this->assertCount(1, $trackMeet->trackEvents);
        $this->assertTrue($trackMeet->trackEvents[0]->is($trackEvent));
    }
}
