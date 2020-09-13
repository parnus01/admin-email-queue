<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTaskEmail extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('task_email', function (Blueprint $table) {
            $table->increments('id');
            $table->tinyInteger('status');
            $table->string('title');
            $table->text('content');
            $table->text('recipients');
            $table->dateTime('exec_time');
            $table->dateTime('create_time');
            $table->dateTime('update_time');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
