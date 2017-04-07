<?php

namespace App\Policies;

use App\User;
use App\Course;
use Illuminate\Auth\Access\HandlesAuthorization;

class CoursePolicy
{
    use HandlesAuthorization;

    public function before(User $user)
    {
        if ($user->hasRole(['owner', 'admin'])) {
            return true;
        }
    }

    /**
     * Determine whether the user can view the course.
     *
     * @param  \App\User  $user
     * @param  \App\Course  $course
     * @return mixed
     */
    public function view(User $user)
    {   //obselete (because auth:middleware) but here just in case it is ever needed (to change)
        return $user != null;
    }

    /**
     * Determine whether the user can create courses.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
       return $user->can('create-courses');
    }

    /**
     * Determine whether the user can update the course.
     *
     * @param  \App\User  $user
     * @param  \App\Course  $course
     * @return mixed
     */
    public function update(User $user, Course $course)
    {
        if ($user->can('create-courses') && $user->id == $course->teacher_id) {
            return true;
        }

        return false;
    }

    /**
     * Determine whether the user can delete the course.
     *
     * @param  \App\User  $user
     * @param  \App\Course  $course
     * @return mixed
     */
    public function delete(User $user, Course $course)
    {
        if ($user->can('create-courses') && $user->id == $course->teacher_id) {
            return true;
        }
        return false;
    }


    public function start(User $user, Course $course)
    {
        
    }
}
