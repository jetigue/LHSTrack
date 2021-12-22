<?php

namespace Tests\Feature;

use App\Http\Livewire\Communication\TeamAnnouncementsIndex;
use App\Models\Users\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TeamAnnouncementsIndexTest extends TestCase
{
    use RefreshDatabase;

    /** @test  */
    function a_guest_cannot_see_announcements_page()
    {
        $this->get('/team-announcements')->assertDontSeeLivewire(TeamAnnouncementsIndex::class);
    }

    /** @test */
    function an_authenticated_user_can_see_the_announcements_page()
    {
        $this->actingAs(User::factory()->make());

        $this->get('/team-announcements')->assertSeeLivewire(TeamAnnouncementsIndex::class);
    }

    /** @test */
    function only_a_coach_can_create_an_announcement()
    {

    }

}
