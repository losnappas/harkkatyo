<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'label'
    ];

    public $timestamps = false;

    public function roles()
    {							
        return $this->belongsToMany(Role::class);
    }
}
