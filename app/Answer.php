<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    protected $fillable = [
        'body'
    ];

    public function tasks()
    {
    	return $this->belongsTo(Task::class);
    }
}
