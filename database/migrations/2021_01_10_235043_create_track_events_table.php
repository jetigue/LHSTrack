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
        if (!Schema::hasTable('event_events')) {
            Schema::create('track_events', function (Blueprint $table) {
                $table->tinyIncrements('id');
                $table->string('name', 50);
                $table->unsignedInteger('distance_in_meters')->nullable();
                $table->unsignedTinyInteger('event_category_id');
                $table->timestamps();

                $table->foreign('event_category_id')->references('id')->on('event_categories');
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
