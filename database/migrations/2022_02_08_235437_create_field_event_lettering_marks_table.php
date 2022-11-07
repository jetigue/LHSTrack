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
        Schema::create('field_event_lettering_marks', function (Blueprint $table) {
            $table->smallIncrements('id');
            $table->unsignedTinyInteger('track_event_id');
            $table->unsignedTinyInteger('gender_id');
            $table->unsignedInteger('freshman_total_inches');
            $table->unsignedTinyInteger('freshman_quarter_inch')->nullable();
            $table->unsignedInteger('sophomore_total_inches');
            $table->unsignedTinyInteger('sophomore_quarter_inch')->nullable();
            $table->unsignedInteger('junior_total_inches');
            $table->unsignedTinyInteger('junior_quarter_inch')->nullable();
            $table->unsignedInteger('senior_total_inches');
            $table->unsignedTinyInteger('senior_quarter_inch')->nullable();
            $table->timestamps();

            $table->foreign('track_event_id')
                ->references('id')
                ->on('track_events');

            $table->foreign('gender_id')
                ->references('id')
                ->on('genders');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('field_event_lettering_marks');
    }
};
