<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTrackTtRacesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('track_tt_races', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('track_time_trial_id');
            $table->unsignedTinyInteger('gender_id');
            $table->unsignedTinyInteger('track_event_id');
            $table->text('notes')->nullable();
            $table->timestamps();

            $table->foreign('track_time_trial_id')
                ->references('id')
                ->on('track_time_trials');

            $table->foreign('gender_id')
                ->references('id')
                ->on('genders');

            $table->foreign('track_event_id')
                ->references('id')
                ->on('track_events');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('track_tt_races');
    }
}
