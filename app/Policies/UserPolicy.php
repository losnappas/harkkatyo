<?php

namespace App\Policies;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;


    /**
     * Determine whether the user can view the user.
     *
     * @param  \App\User  $user
     * @param  \App\User  $user
     * @return mixed
     */
    public function view(User $user, User $user1)
    {
        //return true if
        //owner/admin
        //user is teacher and student is enrolled on teacher's course
        //it is the user themselves user==user
        //will it glitch?
        if ($user->hasRole(['owner', 'admin'])) {
            return true;
        }
        
/* //this is actually garbage?
        if ($user->hasRole('teacher')) {
            var_dump(explode(' ', $user1->courses()->pluck('teacher')));
            if (in_array($user->id, explode(' ', $user1->courses()->pluck('teacher')))) {
                return true;
            }
        }*/

        return $user->id == $user1->id;
    }

    /**
     * Determine whether the user can create users.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the user.
     *
     * @param  \App\User  $user
     * @param  \App\User  $user
     * @return mixed
     */
    public function update(User $user, User $user1)
    {
        if($user->hasRole(['owner', 'admin'])){
            return true;
        }
        return $user->id == $user1->id;
    }

    /**
     * Determine whether the user can delete the user.
     *
     * @param  \App\User  $user
     * @param  \App\User  $user
     * @return mixed
     */
    public function delete(User $user, User $user1)
    {
        if($user->hasRole(['owner', 'admin'])){
            return true;
        }

        return $user->id == $user1->id;
    }
}
