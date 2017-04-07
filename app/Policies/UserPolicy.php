<?php

namespace App\Policies;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    //always return true if
    //owner/admin
    public function before(User $user)
    {
        if ($user->hasRole(['owner', 'admin'])) {
            return true;
        }
    }

    /**
     * Determine whether the user can view the user.
     *
     * @param  \App\User  $user
     * @param  \App\User  $user
     * @return mixed
     */
    public function view(User $user, User $user1)
    {

        //user is teacher and student is enrolled on teacher's course
        //it is the user themselves user==user
        
        
        // teacher can see profiles if they are enrolled on teacher's course
        if ($user->hasRole('teacher')) {
            foreach ($user1->courses as $course) {
                if ($course->teacher->id == $user->id)
                    return true;
            }
        }

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
        return $user->id == $user1->id;
    }

    public function changeRole(User $user)
    {// so basically this was "hasRole" and almost obselete since "before" func.
        return false;
    }
}
