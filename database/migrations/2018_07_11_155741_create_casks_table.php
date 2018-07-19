<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

use Updater\Enumerations\Version;

class CreateCasksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('casks', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->enum('version', [Version::LATEST()])->default(Version::LATEST());
            $table->string('sha256', 64)->nullable();
            $table->string('url');
            $table->string('homepage');
            $table->json('fonts')->nullable();
            $table->timestampsTz();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('casks');
    }
}
