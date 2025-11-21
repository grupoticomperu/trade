<?php

namespace App\Policies;

use App\Models\Transmision;
use App\Models\User;
use Illuminate\Auth\Access\Response;
use Illuminate\Auth\Access\HandlesAuthorization; //agregue esto

class TransmisionPolicy
{
    use HandlesAuthorization;
    //puede hacer de todo

    public function before(User $user, string $ability)
    {
        // Requiere que tu User use HasRoles (Spatie) y role 'admin'
        if (method_exists($user, 'hasRole') && $user->hasRole('admin')) {
            return true;
        }
        return null;
    }


    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('Transmision List');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Transmision $transmision): bool
    {
        return $user->hasPermissionTo('Transmision List');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasPermissionTo('Transmision Create');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Transmision $transmision): bool
    {
        return $user->hasPermissionTo('Transmision Update');
    }
    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Transmision $transmision): bool
    {
        return $user->hasPermissionTo('Transmision Delete');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Transmision $transmision): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Transmision $transmision): bool
    {
        return false;
    }
}
