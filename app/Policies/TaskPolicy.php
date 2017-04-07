<?php

namespace App\Policies;

use App\User;
use App\Task;
use Illuminate\Auth\Access\HandlesAuthorization;

class TaskPolicy
{
    use HandlesAuthorization;

    public function before(User $user)
    {
        if ($user->hasRole(['owner', 'admin'])) {
            return true;
        }
    }

    public function index(User $user)
    {
        return $user->hasRole('teacher');
    }

    /**
     * Determine whether the user can view the task.
     *
     * @param  \App\User  $user
     * @param  \App\Task  $task
     * @return mixed
     */
    public function view(User $user, Task $task)
    {
        return $user->hasRole('teacher');
    }

    /**
     * Determine whether the user can create tasks.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->hasRole('teacher');
    }

    /**
     * Determine whether the user can update the task.
     *
     * @param  \App\User  $user
     * @param  \App\Task  $task
     * @return mixed
     */
    public function update(User $user, Task $task)
    {
        return $user->hasRole('teacher');
    }

    /**
     * Determine whether the user can delete the task.
     *
     * @param  \App\User  $user
     * @param  \App\Task  $task
     * @return mixed
     */
    public function delete(User $user, Task $task)
    {
        return $user->hasRole('teacher');
    }
}
