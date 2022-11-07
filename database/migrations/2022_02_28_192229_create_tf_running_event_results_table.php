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
        Schema::create('tf_running_event_results', function (Blueprint $table) {
            $table->id();
            $table->foreignId('track_team_result_id')->constrained('track_team_results');
            $table->unsignedTinyInteger('track_event_id');
            $table->unsignedBigInteger('athlete_id');
            $table->unsignedSmallInteger('place');
            $table->unsignedInteger('total_seconds');
            $table->unsignedTinyInteger('milliseconds')->nullable();
            $table->float('total_time')->nullable();
            $table->unsignedTinyInteger('points')->nullable();
            $table->float('vdot', 3, 1)->nullable();
            $table->unsignedTinyInteger('heat')->nullable();
            $table->timestamps();

            $table->foreign('athlete_id')
                ->references('id')
                ->on('athletes');

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
        Schema::dropIfExists('tf_running_event_results');
    }
};
