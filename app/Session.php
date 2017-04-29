<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Session extends Model
{
    protected $fillable = [
        'start', 'end', 'completed'
    ];

    public function courses()
    {
    	return $this->belongsTo(Course::class);
    }

    public function users()
    {
    	return $this->belongsTo(User::class);
    }

    public function attempts()
    {
    	return $this->hasMany(Attempt::class);
    }
}
