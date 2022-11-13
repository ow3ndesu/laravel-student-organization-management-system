<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateArchiveOrganizationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('archive_organizations', function (Blueprint $table) {
            $table->id();
            $table->integer('organization_id');
            $table->integer('user_id');
            $table->string('name');
            $table->tinyInteger('status')->default('0'); // 0 meaning not recognized, // 1 is recognized, // 2 is for renewal
            $table->string('organization_created_at');
            $table->string('organization_updated_at');
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
        Schema::dropIfExists('archive_organizations');
    }
}
