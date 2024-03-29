<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->string('image');
            $table->string('name');
            $table->string('place');
            $table->string('date_time');
            $table->string('out');
            $table->string('description');
            $table->string('status')->default('0'); // 0 meaning need approval, // 1 is approved, // 2 is for deletion
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('events');
    }
}
