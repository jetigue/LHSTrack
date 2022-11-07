<?php

namespace Announcements;

use App\Http\Livewire\Communication\TeamAnnouncementsForm;
use App\Http\Livewire\Communication\TeamAnnouncementsIndex;
use App\Models\Users\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TeamAnnouncementsIndexTest extends TestCase
{
    use RefreshDatabase;

    /** @test  */
    public function a_guest_cannot_see_announcements_page()
    {
        $this->get('/team-announcements')->assertDontSeeLivewire(TeamAnnouncementsIndex::class);
    }

    /** @test */
    public function an_authenticated_user_can_see_the_announcements_page()
    {
        $this->actingAs(User::factory()->make());

        $this->get('/team-announcements')->assertSeeLivewire(TeamAnnouncementsIndex::class);
    }

    /** @test */
    public function only_a_coach_can_see_the_form_modal()
    {
        $this->signInCoach();

        $this->get('/team-announcements')->assertSeeLivewire(TeamAnnouncementsForm::class);
    }

    /** @test */
    public function an_athlete_cannot_see_the_form_modal()
    {
        $this->signInAthlete();

        $this->get('/team-announcements')->assertDontSeeLivewire(TeamAnnouncementsForm::class);
    }
}
