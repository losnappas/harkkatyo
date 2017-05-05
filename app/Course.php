<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'body', 'title', 'creation_date', 'task_count', /*'creator'*/
    ];

    public function tasks()
    {							
        return $this->belongsToMany(Task::class);
    }

    /**
     * Add task to course
     *
     * @return task..?
     *///not used/leftover?
    /*public function addTask($body, $title, $deadline)
    {
    	return $this->tasks()->create(['body' => $body, 'title'=>$title, 'deadline' => $deadline]);
    }*/

/*
    public function users()
    {
        return $this->belongsToMany(User::class);
    }*/

    public function teacher()
    {
        return $this->belongsTo(User::class);
    }

    public function sessions()
    {
        return $this->hasMany(Session::class);
    }
}
