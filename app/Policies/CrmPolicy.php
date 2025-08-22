<?php

namespace App\Policies;

use App\Models\Crm;
use App\Models\User;
use Illuminate\Auth\Access\Response;
use Illuminate\Auth\Access\HandlesAuthorization; //agregue esto

//php artisan make:policy CrmPolicy -m Crm
class CrmPolicy
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
        return $user->hasPermissionTo('Crm List');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Crm $crm): bool
    {
         return $user->id === $crm->user_id || $user->hasPermissionTo('Crm View');
    }

 
    public function create(User $user): bool
    {
        return $user->hasRole('Admin')|| $user->hasPermissionTo('Crm Create');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Crm $crm): bool
    {
        return $user->hasRole('Admin')|| $user->hasPermissionTo('Crm Update');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Crm $crm): bool
    {
         return $user->hasRole('Admin') || $user->hasPermissionTo('Crm Delete');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Crm $crm): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Crm $crm): bool
    {
        return false;
    }
}
