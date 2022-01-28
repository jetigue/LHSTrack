<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class BoysTfTtEvents extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('boys_tf_tt_events', function (Blueprint $table) {
            $table->primary(['track_time_trial_id', 'track_event_id']);
            $table->unsignedInteger('track_time_trial_id');
            $table->unsignedTinyInteger('track_event_id');
            $table->unsignedTinyInteger('gender_id')->default(1)->always();
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
        Schema::dropIfExists('boys_tf_tt_events');
    }
}
