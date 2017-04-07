<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

$factory->define(App\User::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->safeEmail,
        'password' => bcrypt(str_random(10)),
        'remember_token' => str_random(10),
    ];
});

//tasks
$factory->define(App\Task::class, function (Faker\Generator $faker)
{
	return [
		'body' => $faker->sentence(2), 
		'title' => $faker->unique()->word, 
		//'deadline' => $faker->dateTimeBetween('now', '+2 weeks'),
		'answer' => $faker->unique()->word, 
	];
});

$factory->define(App\Course::class, function (Faker\Generator $faker)
{
	return [
		'body' => $faker->paragraph(2), 
		'title' => $faker->unique()->word, 
		'teacher_id' => 5
	];
});
