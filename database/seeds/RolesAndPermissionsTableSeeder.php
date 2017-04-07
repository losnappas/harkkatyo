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
        App\Role::create(['name'=>'owner', 'display_name'=>'Project owner', 'description' => 'allows everything']);
        App\Role::create(['name'=>'admin', 'display_name'=>'An administrator', 'description' => 'allows modifying of user related data']);
        App\Role::create(['name'=>'teacher', 'display_name'=>'A teacher', 'description' => 'allows modifying of courses and sees some student data']);
        App\Role::create(['name'=>'student', 'display_name'=>'A student', 'description' => 'nothing but a student']);
        // guest? no need rly. \App\Role::create(['name'=>'guest', 'display_name'=>'A guest', 'description' => 'empty for now']);

        //admin/owner/////covered by userpolicy
        App\Permission::create(['name'=>'modify-users', 'display_name'=>'modify users', 'description' => 'Add/remove/modify user data']);

        App\Permission::create(['name'=>'create-courses', 'display_name'=>'create courses', 'description' => 'Add/remove/modify courses']);

        //attach "modify-users"&"create-courses" to "owner"
        App\Role::first()->permissions()->attach(App\Permission::first());
        App\Role::first()->permissions()->attach(App\Permission::skip(1)->first());
        //App\Role::first()->permissions()->attachPermissions();

/*		//attach subsequent rights "skip"
		\App\Role::first()->permissions()->attach(\App\Permission::skip(1)->first());
		//basically whatever is declared after "can-modify-users"
		*/


    }
}
