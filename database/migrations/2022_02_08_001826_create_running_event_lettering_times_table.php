<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRunningEventLetteringTimesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('running_event_lettering_times', function (Blueprint $table) {
            $table->smallIncrements('id');
            $table->unsignedTinyInteger('track_event_id');
            $table->unsignedTinyInteger('gender_id');
            $table->unsignedInteger('freshman_total_seconds');
            $table->unsignedTinyInteger('freshman_milliseconds')->nullable();
            $table->unsignedInteger('sophomore_total_seconds');
            $table->unsignedTinyInteger('sophomore_milliseconds')->nullable();
            $table->unsignedInteger('junior_total_seconds');
            $table->unsignedTinyInteger('junior_milliseconds')->nullable();
            $table->unsignedInteger('senior_total_seconds');
            $table->unsignedTinyInteger('senior_milliseconds')->nullable();
            $table->timestamps();

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
        Schema::dropIfExists('running_event_lettering_times');
    }
}
