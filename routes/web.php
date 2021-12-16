<?php

use App\Http\Livewire\Athletes\AthletesIndex;
use App\Http\Livewire\Communication\TeamAnnouncementsIndex;
use App\Http\Livewire\Users\UsersIndex;
use App\Http\Livewire\Welcome;
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

Route::get('/admin/users/', UsersIndex::class);

Route::get('/team-announcements', TeamAnnouncementsIndex::class)->name('Team Announcements')->middleware('auth');

Route::get('/athletes', AthletesIndex::class)->name('Athletes');
