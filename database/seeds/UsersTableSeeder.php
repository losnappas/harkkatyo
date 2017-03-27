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
				'name'=>'owner',
				'email'=>'123@123.com',
				'password' => bcrypt('123123'),
			]); 

        factory('App\User', 1)->create([
                'name'=>'admin',
                'email'=>'1234@1234.com',
                'password' => bcrypt('123123'),
            ]);
        $adminuser = App\User::where('name', '=', 'admin')->first();
        //turn 123 into owner
		App\User::find(3)->roles()->attach(App\Role::first());
        $adminuser->attachRole(App\Role::skip(1)->first()->id);

    }
}
