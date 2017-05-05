<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTikoTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {//body == the thing. i.e. body in answers = answer. body in attemps = attempt answer
        Schema::create('answers', function (Blueprint $table) {
            $table->increments('id');
            $table->string('body'); //answer
            $table->unsignedInteger('task_id');
            $table->timestamps();

            $table->foreign('task_id')->references('id')->on('tasks')
                ->onUpdate('cascade')->onDelete('cascade');
        });

        //'start', 'end', 'completed'
        Schema::create('sessions', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamp('end')->nullable();
            $table->unsignedInteger('completed')->default(0);
            $table->unsignedInteger('course_id')->nullable();
            $table->unsignedInteger('user_id')->nullable();
            $table->timestamps(); //start is here

            $table->foreign('course_id')->references('id')->on('courses')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')
                ->onUpdate('cascade')->onDelete('cascade');
        });

        //'start', 'end', 'correct', 'count', 'body'
        //there's a lot of nullable fields so we can save
        //when the attempt starts and edit after it ends.
        Schema::create('attempts', function (Blueprint $table) {
            $table->increments('id');
            $table->string('body')->nullable(); //given answer/attempt
            //$table->timestamp('start');
            $table->timestamp('end')->nullable();
            $table->boolean('correct')->nullable();
            $table->unsignedInteger('count')->nullable();
            $table->unsignedInteger('session_id');
            $table->unsignedInteger('task_id');
            $table->timestamps();//start

            $table->foreign('session_id')->references('id')->on('sessions')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('task_id')->references('id')->on('tasks')
                ->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('answers');
        Schema::drop('attempts');
        Schema::drop('sessions');
    }
}
