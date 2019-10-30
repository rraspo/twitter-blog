<?php

namespace App\Policies;

use App\Entry;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class EntryPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can create entries.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return Auth::check();
    }

    /**
     * Determine whether the user can update the entry.
     *
     * @param  \App\User  $user
     * @param  \App\Entry  $entry
     * @return mixed
     */
    public function update(User $user, Entry $entry)
    {
        return $user->id === $entry->user_id;
    }

    /**
     * Determine whether the user can delete the entry.
     *
     * @param  \App\User  $user
     * @param  \App\Entry  $entry
     * @return mixed
     */
    public function delete(User $user, Entry $entry)
    {
        return $user->id === $entry->user_id;
    }

    /**
     * Determine whether the user can restore the entry.
     *
     * @param  \App\User  $user
     * @param  \App\Entry  $entry
     * @return mixed
     */
    public function restore(User $user, Entry $entry)
    {
        return $user->id === $entry->user_id;
    }

    /**
     * Determine whether the user can permanently delete the entry.
     *
     * @param  \App\User  $user
     * @param  \App\Entry  $entry
     * @return mixed
     */
    public function forceDelete(User $user, Entry $entry)
    {
        return $user->id === $entry->user_id;
    }
}
