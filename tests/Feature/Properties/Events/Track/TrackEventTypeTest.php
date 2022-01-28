<?php

namespace Tests\Feature\Properties\Events\Track;

use App\Http\Livewire\Properties\Events\Track\TrackEventTypesIndex;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TrackEventTypeTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    /** @test */
    public function only_an_admin_can_see_track_event_types_page()
    {
        $this->signInAdmin();

        $this->get('/track/event-types')->assertSeeLivewire(TrackEventTypesIndex::class);


    }
}
