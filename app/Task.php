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
        'body', 'title'/*title not in ER*/, 'creation_date', 'type', 'creator'
    ];

	public function courses()
    {							
        return $this->belongsToMany(Course::class);
    }

    public function answers()
    {
        return $this->hasMany(Answer::class);
    }
}
