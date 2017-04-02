<?php

namespace App;

// use Illuminate\Database\Eloquent\Model;
use Zizaco\Entrust\EntrustRole;

class Role extends EntrustRole /*Model*/
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
   	
   	public function permissions()
    {							
        return $this->belongsToMany(Permission::class);
    }
    

    public function users()
    {                           
        return $this->belongsToMany(User::class);
    }


}
