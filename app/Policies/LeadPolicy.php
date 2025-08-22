<?php

namespace App\Policies;

use App\Models\Lead;
use App\Models\User;
use Illuminate\Auth\Access\Response;
use Illuminate\Auth\Access\HandlesAuthorization; //agregue esto

//php artisan make:policy LeadPolicy -m Lead
class LeadPolicy
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
        return $user->hasPermissionTo('Lead List');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Lead $lead): bool
    {
         //return $user->hasRole('Admin')|| $user->hasPermissionTo('Lead View');
         return $user->id === $lead->user_id || $user->hasPermissionTo('Lead View');
    }

   
    
    public function create(User $user): bool
    {
        return $user->hasRole('Admin')|| $user->hasPermissionTo('Lead Create');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Lead $lead): bool
    {
        return $user->hasRole('Admin')|| $user->hasPermissionTo('Lead Update');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Lead $lead): bool
    {
         return $user->hasRole('Admin') || $user->hasPermissionTo('Lead Delete');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Lead $lead): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Lead $lead): bool
    {
        return false;
    }
}
