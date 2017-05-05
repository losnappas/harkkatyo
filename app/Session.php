<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Session extends Model
{
    protected $fillable = [
        'end', 'completed'
    ];

    public function course()
    {
    	return $this->belongsTo(Course::class);
    }

    public function user()
    {
    	return $this->belongsTo(User::class);
    }

    public function attempts()
    {
    	return $this->hasMany(Attempt::class);
    }
}
