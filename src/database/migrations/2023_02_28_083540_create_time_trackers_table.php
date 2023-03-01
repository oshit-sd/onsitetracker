<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTimeTrackersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('time_trackers', function (Blueprint $table) {
            $table->increments('id');
            $table->foreignId('user_id')->index()->nullable();
            $table->date('date');
            $table->integer('temp_seconds')->default(0);
            $table->bigInteger('seconds')->nullable();
            $table->string('tos_session_key');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('time_trackers');
    }
}
