<?php

namespace App\Policies;

use App\Models\User;
use App\Models\ticket;
use Illuminate\Auth\Access\HandlesAuthorization;

class TicketPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny(User $user)
    {
        if ($user->can('see-all-tickets')) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User $user
     * @param  \App\Models\User  $model
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, User $model)
    {
        return $user->id === $model->id;
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user)
    {
        if ($user->can('create-tickets')) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User $user
     * @param  \App\Models\ticket  $ticket
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, ticket $ticket)
    {
        if ($user->can('edit-tickets')) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User $user
     * @param  \App\Models\ticket  $ticket
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, ticket $ticket)
    {
        if ($user->can('delete-tickets')) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User $user
     * @param  \App\Models\ticket  $ticket
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, ticket $ticket)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User $user
     * @param  \App\Models\ticket  $ticket
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, ticket $ticket)
    {
        //
    }
}