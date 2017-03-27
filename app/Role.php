<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
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

    public function permissions()
    {							
        return $this->belongsToMany(Permission::class);
    }
    

    public function users()
    {                           
        return $this->belongsToMany(User::class);
    }
}