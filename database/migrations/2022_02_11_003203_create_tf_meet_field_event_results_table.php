<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTfMeetFieldEventResultsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tf_meet_field_event_results', function (Blueprint $table) {
            $table->id();
            $table->foreignId('track_meet_id')->constrained('track_meets');
            $table->unsignedTinyInteger('track_event_id');
            $table->unsignedBigInteger('athlete_id');
            $table->unsignedTinyInteger('gender_id');
            $table->unsignedSmallInteger('place');
            $table->unsignedInteger('total_inches');
            $table->unsignedTinyInteger('quarter_inch')->nullable();
            $table->unsignedTinyInteger('points')->nullable();
            $table->unsignedTinyInteger('flight')->nullable();
            $table->timestamps();

            $table->foreign('athlete_id')
                ->references('id')
                ->on('athletes');

            $table->foreign('track_event_id')
                ->references('id')
                ->on('track_events');

            $table->foreign('gender_id')
                ->references('id')
                ->on('genders');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tf_meet_field_event_results');
    }
}
