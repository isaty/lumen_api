<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCheckpointTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('checkpoint', function (Blueprint $table) {
            $table->increments('id');
            $table->string('trip_id');
            $table->integer('checkpoint_no');
            $table->string('checkpoint');
            $table->string('activity');
            $table->string('visiting_status');
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
        Schema::dropIfExists('checkpoint');
    }
}
