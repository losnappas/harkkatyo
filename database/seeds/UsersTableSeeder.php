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
        //$adminuser = App\User::where('name', '=', 'admin')->first();
        //turn 123 into owner & admin
        App\User::find(3)->roles()->attach(App\Role::skip(1)->first());

		App\User::find(3)->roles()->attach(App\Role::first());
        //$adminuser->roles()->attach(App\Role::skip(1)->first()->id);
        App\User::find(4)->roles()->attach(App\Role::skip(1)->first());

        factory('App\User', 1)->create([
                'name'=>'teacher',
                'email'=>'12345@12345.com',
                'password' => bcrypt('123123'),
            ]);

        App\User::find(5)->roles()->attach(App\Role::skip(2)->first());

    }
}
