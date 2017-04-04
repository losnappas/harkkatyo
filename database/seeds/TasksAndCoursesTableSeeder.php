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
        factory('App\Task', 4)->create();
        factory('App\Course', 3)->create();

        //attach task1 to course 1
        //usually do this via controller.
        App\Course::first()->tasks()->attach(App\Task::all());
        //App\User::find(5)->teacher()->detach();
        //App\User::find(5)->teacher()->attach(App\Course::first());
        App\Course::first()->teacher()->associate(App\User::find(5));
    }
}
