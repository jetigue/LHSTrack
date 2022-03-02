<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTrackTeamResultsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('track_team_results', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('track_meet_id');
            $table->unsignedTinyInteger('division_id');
            $table->unsignedSmallInteger('place')->nullable();
            $table->unsignedSmallInteger('points')->nullable();
            $table->unsignedSmallInteger('number_teams');
            $table->text('notes')->nullable();
            $table->string('slug')->nullable();
            $table->timestamps();

            $table->foreign('track_meet_id')
                ->references('id')
                ->on('track_meets');

            $table->foreign('division_id')
                ->references('id')
                ->on('divisions');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('track_team_results');
    }
}
