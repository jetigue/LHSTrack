<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFieldEventLetteringMarksTable extends Migration
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
            $table->enum('freshman_quarter_inch', [0, 1, 2, 3])->default(0);
            $table->unsignedInteger('sophomore_total_inches');
            $table->enum('sophomore_quarter_inch', [0, 1, 2, 3])->default(0);
            $table->unsignedInteger('junior_total_inches');
            $table->enum('junior_quarter_inch', [0, 1, 2, 3])->default(0);
            $table->unsignedInteger('senior_total_inches');
            $table->enum('senior_quarter_inch', [0, 1, 2, 3])->default(0);
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
}
