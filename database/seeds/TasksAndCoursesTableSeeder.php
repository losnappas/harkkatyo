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
        //1
        DB::table('tasks')->insert([
            'body' => 'Valitse opettajien nimet',
            'title' => 'SELECT',
            'creator_id' => 5
        ]);

        DB::table('answers')->insert([
            'body' => 'SELECT opettaja FROM kurssit;',
            'task_id' => 1
        ]);

        //2
        DB::table('tasks')->insert([
            'body' => 'Valitse opiskelijoiden nimet, joilla
pääaineena on ’TKO’.',
            'title' => 'SELECT',
            'creator_id' => 5
        ]);

        DB::table('answers')->insert([
            'body' => "SELECT nimi FROM opiskelijat
WHERE p_aine = 'TKO';",
            'task_id' => 2
        ]);

        //3
        DB::table('tasks')->insert([
            'body' => 'Mitkä ovat ’Villen’ suorittamien
kurssien arvosanat?',
            'title' => 'SELECT',
            'creator_id' => 5
        ]);

        DB::table('answers')->insert([
            'body' => "SELECT suoritukset.arvosana
FROM opiskelijat, suoritukset
WHERE opiskelijat.nro =
suoritukset.op_nro AND
opiskelijat.nimi = 'Ville';",
            'task_id' => 3
        ]);

        //4
        DB::table('tasks')->insert([
            'body' => 'Lisää opiskelija nimeltä Matti tietokantaan. Matin opiskelijanumero on 1234 ja pääaine VT.',
            'title' => 'INSERT',
            'creator_id' => 5
        ]);

        DB::table('answers')->insert([
            'body' => "INSERT INTO opiskelijat VALUES(1234, 'Matti', 'VT');",
            'task_id' => 4
        ]);

        //5
        DB::table('tasks')->insert([
            'body' => 'Poista opiskelija, jonka numero on 1234.',
            'title' => 'DELETE',
            'creator_id' => 5
        ]);

        DB::table('answers')->insert([
            'body' => "DELETE FROM opiskelijat WHERE
nro = 1234;",
            'task_id' => 5
        ]);


        //series 1
        DB::table('courses')->insert([
            'body' => 'Tietokannasta lukeminen',
            'title' => 'SQL 1: perusteet',
            'teacher_id' => 5
        ]);

        //series 2
        DB::table('courses')->insert([
            'body' => 'Lisäys ja poisto -operaatiot',
            'title' => 'SQL 2',
            'teacher_id' => 5
        ]);

        //series 1
        App\Course::first()->tasks()->attach(App\Task::take(3)->get());
        //series 2
        App\Course::find(2)->tasks()->attach(App\Task::first());
        App\Course::find(2)->tasks()->attach(App\Task::skip(3)->take(2)->get());

        /*factory('App\Task', 4)->create();
        factory('App\Course', 3)->create();
        factory('App\Answer', 1)->create();*/



        //attach task1 to course 1
        //usually do this via controller.
        // App\Course::first()->tasks()->attach(App\Task::all());
    }
}
