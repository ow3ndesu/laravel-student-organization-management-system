<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateArchiveAnnouncementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('archive_announcements', function (Blueprint $table) {
            $table->id();
            $table->string('announcement_id');
            $table->string('user_id');
            $table->string('title');
            $table->string('announcement');
            $table->string('status')->default('0');; // 0 meaning need approval, // 1 is approved, // 2 is for deletion
            $table->string('announcement_created_at');
            $table->string('announcement_updated_at');
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
        Schema::dropIfExists('archive_announcements');
    }
}
