<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    protected $fillable = [
        'body'
    ];

    public function task()
    {
    	return $this->belongsTo(Task::class);
    }
}
