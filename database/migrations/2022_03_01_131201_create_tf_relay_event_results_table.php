<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tf_relay_event_results', function (Blueprint $table) {
            $table->id();
            $table->foreignId('track_team_result_id')->constrained('track_team_results');
            $table->unsignedTinyInteger('track_event_id');
            $table->char('relay_team', 1);
            $table->unsignedSmallInteger('place');
            $table->unsignedInteger('total_seconds');
            $table->unsignedTinyInteger('milliseconds')->nullable();
            $table->foreignId('leg_1_athlete_id')->constrained('athletes');
            $table->foreignId('leg_2_athlete_id')->constrained('athletes');
            $table->foreignId('leg_3_athlete_id')->constrained('athletes');
            $table->foreignId('leg_4_athlete_id')->constrained('athletes');
            $table->unsignedInteger('leg_1_total_seconds')->nullable();
            $table->unsignedTinyInteger('leg_1_milliseconds')->nullable();
            $table->unsignedInteger('leg_2_total_seconds')->nullable();
            $table->unsignedTinyInteger('leg_2_milliseconds')->nullable();
            $table->unsignedInteger('leg_3_total_seconds')->nullable();
            $table->unsignedTinyInteger('leg_3_milliseconds')->nullable();
            $table->unsignedInteger('leg_4_total_seconds')->nullable();
            $table->unsignedTinyInteger('leg_4_milliseconds')->nullable();
            $table->unsignedTinyInteger('points')->nullable();
            $table->unsignedTinyInteger('heat')->nullable();
            $table->timestamps();

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
        Schema::dropIfExists('tf_relay_event_results');
    }
};
