<?php

namespace Database\Seeders;

use App\Models\Athletes\Athlete;
use App\Models\Communication\TeamAnnouncement;
use App\Models\Communication\TeamEvent;
use App\Models\Users\Role;
use App\Models\Users\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Role::factory(5)->create();
        User::factory(10)->create();
        Athlete::factory(200)->create();
        TeamAnnouncement::factory(5)->create();
        TeamEvent::factory(10)->create();
    }
}
