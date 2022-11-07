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
        if (! Schema::hasTable('boys_tf_tt_events')) {
            Schema::create('boys_tf_tt_events', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('track_time_trial_id');
                $table->unsignedTinyInteger('track_event_id');
                $table->unsignedTinyInteger('gender_id')->default(1)->always();
                $table->timestamps();

                $table->unique(['track_time_trial_id', 'track_event_id']);

                $table->foreign('track_time_trial_id')
                    ->references('id')
                    ->on('track_time_trials')
                    ->onDelete('cascade');

                $table->foreign('track_event_id')
                    ->references('id')
                    ->on('track_events')
                    ->onDelete('cascade');

                $table->foreign('gender_id')
                    ->references('id')
                    ->on('genders');
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
        Schema::dropIfExists('boys_tf_tt_events');
    }
};
