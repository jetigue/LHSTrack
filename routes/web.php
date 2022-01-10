<?php

use App\Http\Livewire\Athletes\AthleteProfile;
use App\Http\Livewire\Athletes\AthletesIndex;
use App\Http\Livewire\Calendar\MonthlyCalendar;
use App\Http\Livewire\Communication\TeamAnnouncementsIndex;
use App\Http\Livewire\Communication\TeamEventsIndex;
use App\Http\Livewire\Dashboard;
use App\Http\Livewire\Main\BoosterClubPage;
use App\Http\Livewire\Main\OurTeam;
use App\Http\Livewire\Main\TeamRoster;
use App\Http\Livewire\Main\Welcome;
use App\Http\Livewire\Meets\TrackMeetsIndex;
use App\Http\Livewire\Properties\Meets\MeetHostsIndex;
use App\Http\Livewire\Properties\Meets\TimingMethodsIndex;
use App\Http\Livewire\Properties\Meets\Track\TrackMeetNamesIndex;
use App\Http\Livewire\Properties\Meets\Track\TrackSeasonsIndex;
use App\Http\Livewire\Properties\Meets\Track\TrackSurfacesIndex;
use App\Http\Livewire\Properties\Meets\Track\TrackVenuesIndex;
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
Route::get('/boys-roster', TeamRoster::class)->name('Boys Roster');
Route::get('/girls-roster', TeamRoster::class)->name('Girls Roster');
Route::get('/booster-club', BoosterClubPage::class)->name('Booster Club');

Route::get('/dashboard', Dashboard::class)->name('Dashboard')->middleware('auth');

Route::get('/calendar', MonthlyCalendar::class)->name('Calendar');



Route::group(['middleware' => 'can:coach'], function () {
    Route::get('/team-announcements', TeamAnnouncementsIndex::class)->name('Team Announcements');
    Route::get('/team-events', TeamEventsIndex::class)->name('Team Events');

    Route::get('/track-meets', TrackMeetsIndex::class)->name('Track Meets');
    Route::get('/track/meet-names', TrackMeetNamesIndex::class);
    Route::get('/track/venues', TrackVenuesIndex::class)->name('Track venues');
    Route::get('/track/seasons', TrackSeasonsIndex::class)->name('Track Seasons');
    Route::get('/track/surfaces', TrackSurfacesIndex::class)->name('Track Surfaces');
    Route::get('/meet-hosts', MeetHostsIndex::class)->name('Meet Hosts');
    Route::get('/timing-methods', TimingMethodsIndex::class)->name('Timing Methods');

    Route::get('/athletes', AthletesIndex::class)->name('Athletes');
    Route::get('/athletes/{athlete:slug}', AthleteProfile::class)->name('athlete');
});

Route::group(['middleware' => 'can:admin'], function () {
    Route::get('/admin/users/', UsersIndex::class)->name('Users');
});

