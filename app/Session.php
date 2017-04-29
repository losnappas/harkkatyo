<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Session extends Model
{
    protected $fillable = [
        'start', 'end', 'completed'
    ];

    public function course()
    {
    	return $this->belongsTo(Course::class);
    }

    public function user()
    {
    	return $this->belongsTo(User::class);
    }

    public function attempt()
    {
    	return $this->hasMany(Attempt::class);
    }
}
