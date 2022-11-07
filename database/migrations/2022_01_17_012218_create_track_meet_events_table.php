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
        Schema::create('track_meet_events', function (Blueprint $table) {
            $table->primary(['track_meet_id', 'track_event_id']);
            $table->unsignedInteger('track_meet_id');
            $table->unsignedTinyInteger('track_event_id');
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
        Schema::dropIfExists('track_meet_events');
    }
};
