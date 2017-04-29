<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Attempt extends Model
{
    protected $fillable = [
        'start', 'end', 'correct', 'count', 'answer'
    ];
}
