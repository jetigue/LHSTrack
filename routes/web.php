<?php

use App\Http\Livewire\Athletes\AthleteProfile;
use App\Http\Livewire\Athletes\AthletesIndex;
use App\Http\Livewire\Calendar\MonthlyCalendar;
use App\Http\Livewire\Communication\TeamAnnouncementsIndex;
use App\Http\Livewire\Communication\TeamEventsIndex;
use App\Http\Livewire\Main\BoosterClubPage;
use App\Http\Livewire\Main\OurTeam;
use App\Http\Livewire\Main\TeamRoster;
use App\Http\Livewire\Main\Welcome;
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

Route::get('/calendar', MonthlyCalendar::class)->name('Calendar');

Route::get('/admin/users/', UsersIndex::class)->middleware('auth');

Route::get('/team-announcements', TeamAnnouncementsIndex::class)->name('Team Announcements')->middleware('auth');
Route::get('/team-events', TeamEventsIndex::class)->name('Team Events')->middleware('auth');

Route::get('/athletes', AthletesIndex::class)->name('Athletes')->middleware('auth');
Route::get('/athletes/{athlete:slug}', AthleteProfile::class)->name('athlete');
