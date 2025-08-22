<?php

namespace App\Policies;

use App\Models\Category;
use App\Models\User;
use Illuminate\Auth\Access\Response;
use Illuminate\Auth\Access\HandlesAuthorization; //agregue esto
//Si decides no usar la clase HandlesAuthorization,
//las políticas seguirán funcionando, pero perderás la facilidad
//de usar métodos como allow(), deny(), y before().

class CategoryPolicy
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

    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('User Category');
    }

    //solo puede ver un modelo, solo un registro valido para show
    public function view(User $user, Category $category): bool
    {
        return $user->hasPermissionTo('Category View');
        
    }

    public function create(User $user): bool
    {
         return $user->hasPermissionTo('Category Create');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Category $category): bool
    {
         return $user->hasPermissionTo('Category Update');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Category $category): bool
    {
        return $user->hasPermissionTo('Category Delete');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Category $category): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Category $category): bool
    {
        return false;
    }
}
