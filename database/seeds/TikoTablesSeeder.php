<?php

use Illuminate\Database\Seeder;

class TikoTablesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory('App\Session', 1)->create();
        factory('App\Answer', 1)->create();
    }
}
