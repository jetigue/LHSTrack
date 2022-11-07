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
        Schema::create('tf_meet_events', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('track_team_result_id');
            $table->unsignedTinyInteger('track_event_id');
            $table->timestamps();

            $table->unique(['track_team_result_id', 'track_event_id']);

            $table->foreign('track_team_result_id')
                ->references('id')
                ->on('track_team_results')
                ->onDelete('cascade');

            $table->foreign('track_event_id')
                ->references('id')
                ->on('track_events')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tf_meet_events');
    }
};
