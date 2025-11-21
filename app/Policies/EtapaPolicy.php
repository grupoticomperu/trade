<?php

namespace App\Policies;

use App\Models\Etapa;
use App\Models\User;
use Illuminate\Auth\Access\Response;
use Illuminate\Auth\Access\HandlesAuthorization; //agregue esto

class EtapaPolicy
{
    //agregue esto, chat gpt recomienda ponerlo
    use HandlesAuthorization;
    //puede hacer de todo
    public function before($user)
    {
        if ($user->hasRole('Admin')) {
            return true;
        }
    }


    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('Etapa List');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Etapa $etapa): bool
    {
        return $user->hasPermissionTo('Etapa List');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
         return $user->hasPermissionTo('Etapa List');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Etapa $etapa): bool
    {
        return $user->hasPermissionTo('Etapa Update');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Etapa $etapa): bool
    {
        return $user->hasPermissionTo('Etapa Delete');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Etapa $etapa): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Etapa $etapa): bool
    {
        return false;
    }
}
