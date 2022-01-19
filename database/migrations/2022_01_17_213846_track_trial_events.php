<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TrackTrialEvents extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('track_trial_events', function (Blueprint $table) {
            $table->primary(['track_time_trial_id', 'track_event_id']);
            $table->unsignedInteger('track_time_trial_id');
            $table->unsignedTinyInteger('track_event_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('track_trial_events');
    }
}
