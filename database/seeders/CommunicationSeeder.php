<?php

namespace Database\Seeders;

use App\Models\Communication\TeamAnnouncement;
use App\Models\Communication\TeamEvent;
use Illuminate\Database\Seeder;

class CommunicationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        TeamAnnouncement::factory(10)->create();
        TeamEvent::factory(20)->create();
    }
}
