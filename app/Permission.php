<?php

namespace App;

// use Illuminate\Database\Eloquent\Model;
use Zizaco\Entrust\EntrustPermission;

class Permission extends EntrustPermission /*Model*/
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'display_name', 'description'
    ];

    public $timestamps = false;

    public function roles()
    {							
        return $this->belongsToMany(Role::class);
    }

}
