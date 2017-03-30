<?php

use Illuminate\Database\Seeder;

class TasksAndCoursesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory('App\Task', 2)->create();
        factory('App\Course', 1)->create();

        //attach task1 to course 1
        //usually do this via controller.
        App\Course::first()->tasks()->attach(App\Task::first());
    }
}
