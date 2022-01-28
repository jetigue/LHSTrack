<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTrackEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('track_events')) {
            Schema::create('track_events', function (Blueprint $table) {
                $table->tinyIncrements('id');
                $table->string('name', 50);
                $table->unsignedInteger('distance_in_meters')->nullable();
                $table->unsignedTinyInteger('track_event_subtype_id');
                $table->boolean('boys_event')->default(1);
                $table->boolean('girls_event')->default(1);
                $table->boolean('ghsa_event')->default(1);
                $table->timestamps();

                $table->foreign('track_event_subtype_id')->references('id')->on('track_event_subtypes');
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('track_events');
    }
}
