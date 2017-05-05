<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'body', 'title'/*==type*/, 'creation_date', /*'creator'*/
    ];

    //M:N
	public function courses()
    {							
        return $this->belongsToMany(Course::class);
    }

    //task 1:N thing
    public function answers()
    {
        return $this->hasMany(Answer::class);
    }

    public function attempts()
    {
        return $this->hasMany(Attempt::class);
    }

    public function creator()
    {
        return $this->belongsTo(User::class);
    }
}
