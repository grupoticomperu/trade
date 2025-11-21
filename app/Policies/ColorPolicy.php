<?php

namespace App\Policies;

use App\Models\Color;
use App\Models\User;
use Illuminate\Auth\Access\Response;
use Illuminate\Auth\Access\HandlesAuthorization; //agregue esto

class ColorPolicy
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
        return $user->hasPermissionTo('Color List');
    }

    //solo puede ver un modelo, solo un registro valido para show
     public function view(User $user, Color $color): bool
    {
        return $user->hasPermissionTo('Color View');
    }


    public function create(User $user): bool
    {
        return $user->hasPermissionTo('Color Create');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Color $color): bool
    {
        return $user->hasPermissionTo('Color Update');
    }


    public function delete(User $user, Color $color): bool
    {
        return $user->hasPermissionTo('Color Delete');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Color $color): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Color $color): bool
    {
        return false;
    }
}
