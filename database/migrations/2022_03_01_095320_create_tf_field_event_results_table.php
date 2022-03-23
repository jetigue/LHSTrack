<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTfFieldEventResultsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tf_field_event_results', function (Blueprint $table) {
            $table->id();
            $table->foreignId('track_team_result_id')->constrained('track_team_results');
            $table->unsignedTinyInteger('track_event_id');
            $table->unsignedBigInteger('athlete_id');
            $table->unsignedSmallInteger('place');
            $table->unsignedInteger('total_inches');
            $table->float('total_distance', 7, 2)->nullable();
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
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tf_field_event_results');
    }
}
