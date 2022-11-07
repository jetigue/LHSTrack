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
        Schema::create('athletes', function (Blueprint $table) {
            $table->id();
            $table->string('first_name', 50);
            $table->string('last_name', 50);
            $table->char('sex', 1);
            $table->date('dob')->nullable();
            $table->unsignedSmallInteger('grad_year');
            $table->char('status', 1);
            $table->unsignedTinyInteger('track_event_subtype_id')->nullable();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->date('physical_expiration_date')->nullable();
            $table->string('slug')->nullable();
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('track_event_subtype_id')->references('id')->on('track_event_subtypes');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('athletes');
    }
};
