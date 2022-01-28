<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDivisionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('divisions', function (Blueprint $table) {
            $table->tinyIncrements('id');
            $table->unsignedTinyInteger('gender_id');
            $table->unsignedTinyInteger('level_id');
            $table->string('slug')->nullable();
            $table->timestamps();

            $table->foreign('gender_id')->references('id')
                ->on('genders');

            $table->foreign('level_id')->references('id')
                ->on('levels');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('divisions');
    }
}
