<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTrackTimeTrialsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('track_time_trials', function (Blueprint $table) {
            $table->id();
            $table->string('name', 100);
            $table->date('trial_date');
            $table->unsignedSmallInteger('track_venue_id');
            $table->unsignedTinyInteger('timing_method_id');
            $table->string('slug')->nullable();
            $table->timestamps();

            $table->foreign('track_venue_id')
                ->references('id')
                ->on('track_venues');

            $table->foreign('timing_method_id')
                ->references('id')
                ->on('timing_methods');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('track_time_trials');
    }
}
