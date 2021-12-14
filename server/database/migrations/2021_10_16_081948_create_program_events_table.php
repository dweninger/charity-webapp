<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProgramEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('program_events', function (Blueprint $table) {
            $table->integer('program_id')->unsigned();
            $table->integer('event_id')->unsigned();
            $table->foreign('program_id')->references('id')->on('programs')
                ->onDelete('cascade');
            $table->foreign('event_id')->references('id')->on('events')
                ->onDelete('cascade');
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('program_events');
    }
}
