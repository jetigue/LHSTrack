<?php

namespace Database\Seeders;

use App\Models\Properties\Events\EventCategory;
use App\Models\Properties\Events\TrackEvent;
use Illuminate\Database\Seeder;

class TrackEventSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        EventCategory::factory(5)->create();
        TrackEvent::factory(16)->create();
    }
}
