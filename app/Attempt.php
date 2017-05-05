<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Attempt extends Model
{
    protected $fillable = [
        'start', 'end', 'correct', 'count', 'body'
    ];

    public function session()
    {
    	return $this->belongsTo(Session::class);
    }

    public function task()
    {
    	return $this->belongsTo(Task::class);
    }
}
