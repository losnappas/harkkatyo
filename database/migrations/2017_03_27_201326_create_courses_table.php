<?php

use Illuminate\Support\Facades\Schema;
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
            $table->string('subject');
            $table->timestamps();
        });

        Schema::create('tasks', function (Blueprint $table) {
            $table->increments('id');
            $table->string('body');
            $table->string('title');
            $table->date('deadline');
            $table->timestamps();
        });

        Schema::create('course_task', function (Blueprint $table)
        {
            $table->unsignedInteger('course_id');
            $table->unsignedInteger('task_id');
            
            //no foreign key constraints (vs entrust_setup_tables)? interesting
            $table->unique(['course_id', 'task_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('courses');
        Schema::dropIfExists('tasks');
        Schema::dropIfExists('course_task');
    }
}
