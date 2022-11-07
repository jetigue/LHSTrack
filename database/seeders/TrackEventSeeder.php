<?php

namespace Database\Seeders;

use App\Models\Properties\Events\Track\TrackEvent;
use App\Models\Properties\Events\Track\TrackEventSubtype;
use App\Models\Properties\Events\Track\TrackEventType;
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
        TrackEventType::factory(3)->create();
        TrackEventSubtype::factory(6)->create();
        TrackEvent::factory(20)->create();
    }
}
