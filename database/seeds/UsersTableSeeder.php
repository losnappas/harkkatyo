<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory('App\User', 2)->create();

		factory('App\User', 1)->create([
				'name'=>'123',
				'email'=>'123@123.com',
				'password' => bcrypt('123123'),
			]); 

        //turn 123 into admin
		App\User::find(3)->roles()->attach(App\Role::first());

    }
}
