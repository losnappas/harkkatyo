<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCoursesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('courses', function (Blueprint $table) {
            $table->increments('id');
            $table->string('body');
            $table->string('title');
            $table->unsignedInteger('teacher_id'); //creator
            // $table->unsignedInteger('task_count'); //added TIKO
            $table->timestamps(); //created_at included here

            $table->foreign('teacher_id')->references('id')->on('users');
        });

        Schema::create('tasks', function (Blueprint $table) {
            $table->increments('id');
            $table->string('body');
            $table->string('title'); // will serve as type in TIKO
            // $table->string('answer'); //gotta fix this.
            $table->unsignedInteger('creator_id'); //creator
            $table->timestamps();

            $table->foreign('creator_id')->references('id')->on('users');
        });

        Schema::create('course_task', function (Blueprint $table)
        {
/*            //how manieth question
            $table->unsignedInteger('count');*/

            $table->unsignedInteger('course_id');
            $table->unsignedInteger('task_id');


            $table->foreign('task_id')->references('id')->on('tasks')
                ->onUpdate('cascade')->onDelete('cascade');


            $table->foreign('course_id')->references('id')->on('courses')
                ->onUpdate('cascade')->onDelete('cascade');

            $table->primary(['course_id', 'task_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('course_task');
        Schema::drop('courses');
        Schema::drop('tasks');
    }
}
