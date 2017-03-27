<?php

use Illuminate\Database\Seeder;

class RolesAndPermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\Role::create(['name'=>'admin', 'label'=>'The administrator']);
        App\Role::create(['name'=>'teacher', 'label'=>'A teacher']);
        App\Role::create(['name'=>'student', 'label'=>'Student']);
        // guest? no need rly. \App\Role::create(['name'=>'guest', 'label'=>'A guest']);

        App\Permission::create(['name'=>'can-modify-users', 'label'=>'Add/remove/modify user data']);

        //attach "can-modify-users" to "admin"
        App\Role::first()->permissions()->attach(\App\Permission::first());

/*		//attach subsequent rights "skip"
		\App\Role::first()->permissions()->attach(\App\Permission::skip(1)->first());
		//basically whatever is declared after "can-modify-users"
		*/


    }
}
