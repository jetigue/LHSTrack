<?php

namespace Database\Seeders;

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
        TrackTimeTrial::factory(10)->create();
    }
}
