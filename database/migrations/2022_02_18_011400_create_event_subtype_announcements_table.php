<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEventSubtypeAnnouncementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('event_subtype_announcements', function (Blueprint $table) {
            $table->id();
            $table->date('begin_date');
            $table->date('end_date');
            $table->string('title');
            $table->text('body');
            $table->unsignedBigInteger('user_id');
            $table->unsignedTinyInteger('track_event_subtype_id');
            $table->timestamps();

            $table->foreign('user_id')
                ->references('id')
                ->on('users');


            $table->foreign('track_event_subtype_id')
                ->references('id')
                ->on('track_event_subtypes');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('event_subtype_announcements');
    }
}
