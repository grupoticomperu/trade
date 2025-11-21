<?php

namespace App\Policies;

use App\Models\Combustible;
use App\Models\User;
use Illuminate\Auth\Access\Response;
use Illuminate\Auth\Access\HandlesAuthorization; //agregue esto

class CombustiblePolicy
{
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
        return $user->hasPermissionTo('Combustible List');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Combustible $combustible): bool
    {
        return $user->hasPermissionTo('Combustible View');
    }


    public function create(User $user): bool
    {
        return $user->hasPermissionTo('Combustible Create');
    }


    public function update(User $user, Combustible $combustible): bool
    {
        return $user->hasPermissionTo('Combustible Update');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Combustible $combustible): bool
    {
        return $user->hasPermissionTo('Combustible Delete');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Combustible $combustible): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Combustible $combustible): bool
    {
        return false;
    }
}
