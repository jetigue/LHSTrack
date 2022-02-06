<?php

namespace Database\Seeders;

use App\Models\Properties\Races\Division;
use App\Models\Properties\Races\Gender;
use App\Models\TimeTrials\TrackTimeTrial;
use Illuminate\Database\Seeder;

class TrackTimeTrialSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Gender::factory(2)->create();
        TrackTimeTrial::factory(10)->create();
    }
}
