<?php

use App\Http\Livewire\Athletes\AthleteProfile;
use App\Http\Livewire\Athletes\AthletesIndex;
use App\Http\Livewire\Calendar\MonthlyCalendar;
use App\Http\Livewire\Communication\TeamAnnouncementsIndex;
use App\Http\Livewire\Communication\TeamEventsIndex;
use App\Http\Livewire\Dashboard;
use App\Http\Livewire\Main\OurTeam;
use App\Http\Livewire\Main\Welcome;
use App\Http\Livewire\Meets\Track\Results\ShowTeamResult;
use App\Http\Livewire\Meets\Track\Results\TeamResultsEventResultsIndex;
use App\Http\Livewire\Meets\Track\ShowTrackMeet;
use App\Http\Livewire\Meets\Track\TrackMeetsIndex;
use App\Http\Livewire\Properties\Events\Track\TrackEventsIndex;
use App\Http\Livewire\Properties\Events\Track\TrackEventSubtypesIndex;
use App\Http\Livewire\Properties\Events\Track\TrackEventTypesIndex;
use App\Http\Livewire\Properties\Meets\MeetHostsIndex;
use App\Http\Livewire\Properties\Meets\TimingMethodsIndex;
use App\Http\Livewire\Properties\Meets\Track\TrackMeetNamesIndex;
use App\Http\Livewire\Properties\Meets\Track\TrackSeasonsIndex;
use App\Http\Livewire\Properties\Meets\Track\TrackSurfacesIndex;
use App\Http\Livewire\Properties\Meets\Track\TrackVenuesIndex;
use App\Http\Livewire\Properties\Races\DivisionsIndex;
use App\Http\Livewire\Properties\Races\GendersIndex;
use App\Http\Livewire\Properties\Races\LevelsIndex;
use App\Http\Livewire\Properties\Races\TitlesIndex;
use App\Http\Livewire\Team\Lettering\TeamLetteringStandards;
use App\Http\Livewire\Team\TrackRankings;
use App\Http\Livewire\TimeTrials\ShowTrackTimeTrial;
use App\Http\Livewire\TimeTrials\TrackTimeTrialRunningEventResultsIndex;
use App\Http\Livewire\TimeTrials\TrackTimeTrialsIndex;
use App\Http\Livewire\Training\DistanceTrainingPacesIndex;
use App\Http\Livewire\Training\EventPages\EventPageIndex;
use App\Http\Livewire\Training\EventPages\EventSubtypeCalendarContainer;
use App\Http\Livewire\Users\UserRolesIndex;
use App\Http\Livewire\Users\UsersIndex;
use Illuminate\Support\Facades\Route;

require __DIR__.'/auth.php';
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', Welcome::class)->name('home');
Route::get('/our-team', OurTeam::class)->name('Our Team');
Route::get('/dashboard', Dashboard::class)->name('Dashboard')->middleware('auth');
Route::get('/calendar', MonthlyCalendar::class)->name('Calendar');

Route::get('/team-announcements', TeamAnnouncementsIndex::class)->name('Team Announcements');
Route::get('/team-events', TeamEventsIndex::class)->name('Team Events');
Route::get('/lettering-standards', TeamLetteringStandards::class)->name('Lettering Standards');

Route::get('/athletes/{athlete:slug}', AthleteProfile::class)->name('athlete');

Route::middleware('auth')->group(function () {
    Route::get('training/distance', EventPageIndex::class)->name('Distance');
    Route::get('training/distance-calendar', EventSubtypeCalendarContainer::class)->name('Distance Calendar');
    Route::get('training/hurdles', EventPageIndex::class)->name('Hurdles');
    Route::get('training/hurdles-calendar', EventSubtypeCalendarContainer::class)->name('Hurdles Calendar');
    Route::get('training/jumps', EventPageIndex::class)->name('Jumps');
    Route::get('training/jumps-calendar', EventSubtypeCalendarContainer::class)->name('Jumps Calendar');
    Route::get('training/pole-vault', EventPageIndex::class)->name('Pole Vault');
    Route::get('training/pole-vault-calendar', EventSubtypeCalendarContainer::class)->name('Pole Vault Calendar');
    Route::get('training/sprints', EventPageIndex::class)->name('Sprints');
    Route::get('training/sprints-calendar', EventSubtypeCalendarContainer::class)->name('Sprints Calendar');
    Route::get('training/throws', EventPageIndex::class)->name('Throws');
    Route::get('training/throws-calendar', EventSubtypeCalendarContainer::class)->name('Throws Calendar');

    Route::get('track/rankings', TrackRankings::class)->name('Track Rankings');

    Route::get('/track/meets', TrackMeetsIndex::class)->name('Track Meets');
    Route::get('/track/meets/{trackMeet:slug}', ShowTrackMeet::class);
    Route::get('/track/meets/team-results/{teamResult:slug}', ShowTeamResult::class);
    Route::get('/track/meets/team-results/{teamResult:slug}/event-results/{trackEvent:slug}', TeamResultsEventResultsIndex::class);
    Route::get('/track/meets/{trackMeet:slug}/boys/events/{trackEvent:slug}', TeamResultsEventResultsIndex::class);
    Route::get('/track/meets/{trackMeet:slug}/girls/events/{trackEvent:slug}', TeamResultsEventResultsIndex::class);
});

Route::middleware('can:coach')->group(function () {
    Route::get('/track/meet-names', TrackMeetNamesIndex::class)->name('Track Meet Names');
    Route::get('/track/venues', TrackVenuesIndex::class)->name('Track Venues');
    Route::get('/meet-hosts', MeetHostsIndex::class)->name('Meet Hosts');

    Route::get('/track/time-trials', TrackTimeTrialsIndex::class)->name('Track Time Trials');
    Route::get('/track/time-trials/{timeTrial:slug}', ShowTrackTimeTrial::class);
    Route::get('/track/time-trials/{timeTrial:slug}/boys/events/{trackEvent:slug}', TrackTimeTrialRunningEventResultsIndex::class);
    Route::get('/track/time-trials/{timeTrial:slug}/girls/events/{trackEvent:slug}', TrackTimeTrialRunningEventResultsIndex::class);

    Route::get('/athletes', AthletesIndex::class)->name('Athletes');
    Route::get('/athletes/physicals', AthletesIndex::class)->name('Physicals');

    Route::get('/training/paces/distance', DistanceTrainingPacesIndex::class)->name('Distance Training Paces');
});

Route::middleware('can:admin')->group(function () {
    Route::get('/admin/users/', UsersIndex::class)->name('Users');
    Route::get('/admin/user-roles/', UserRolesIndex::class)->name('User Roles');

    Route::get('/properties/timing-methods', TimingMethodsIndex::class)->name('Timing Methods');
    Route::get('/track/event-subtypes', TrackEventSubtypesIndex::class)->name('Track Event Subtypes');
    Route::get('/track/event-types', TrackEventTypesIndex::class)->name('Track Event Types');
    Route::get('/track/events', TrackEventsIndex::class)->name('Track Events');
    Route::get('/track/seasons', TrackSeasonsIndex::class)->name('Track Seasons');
    Route::get('/track/surfaces', TrackSurfacesIndex::class)->name('Track Surfaces');

    Route::get('/properties/genders', GendersIndex::class)->name('Genders');
    Route::get('/properties/levels', LevelsIndex::class)->name('Levels');
    Route::get('/properties/race-titles', TitlesIndex::class)->name('Race Titles');
    Route::get('/properties/divisions', DivisionsIndex::class)->name('Divisions');
});
