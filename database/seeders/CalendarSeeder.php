<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CalendarSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $path = public_path('scripts/calendar/populateIntsTable.sql');
        $sql = file_get_contents($path);
        DB::unprepared($sql);

        $path = public_path('scripts/calendar/populateCalendarTable.sql');
        $sql = file_get_contents($path);
        DB::unprepared($sql);

        $path = public_path('scripts/calendar/updateCalendarTable.sql');
        $sql = file_get_contents($path);
        DB::unprepared($sql);
    }
}
