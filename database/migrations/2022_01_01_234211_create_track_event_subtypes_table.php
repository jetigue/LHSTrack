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
        if (! Schema::hasTable('track_event_subtypes')) {
            Schema::create('track_event_subtypes', function (Blueprint $table) {
                $table->tinyIncrements('id');
                $table->string('name', 50);
                $table->unsignedTinyInteger('track_event_type_id');
                $table->timestamps();

                $table->foreign('track_event_type_id')->references('id')->on('track_event_types');
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
        Schema::dropIfExists('track_event_subtypes');
    }
};
