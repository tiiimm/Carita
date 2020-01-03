<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCharityEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('charity_events', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('charity_id');
            $table->string('title');
            $table->string('description');
            $table->string('venue');
            $table->string('photo');
            $table->integer('points');
            $table->date('held_on_from');
            $table->date('held_on_to');
            $table->date('open_from');
            $table->date('open_to');
            $table->timestamps();
            
            $table->foreign('charity_id')->references('id')->on('charities')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('charity_events');
    }
}
