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
        'body', 'title', 'answer' // add 'answer'
    ];

	public function courses()
    {							
        return $this->belongsToMany(Course::class);
    }
}
