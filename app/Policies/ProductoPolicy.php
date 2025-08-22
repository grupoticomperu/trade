<?php

namespace App\Policies;

use App\Models\Producto;
use App\Models\User;
use Illuminate\Auth\Access\Response;
use Illuminate\Auth\Access\HandlesAuthorization; //agregue esto

//php artisan make:policy ProductoPolicy -m Producto
class ProductoPolicy
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
        //return $user->hasPermissionTo('Producto List');
        return true;
    }


    public function view(User $user, Producto $producto): bool
    {
        return $user->id === $producto->user_id || $user->hasPermissionTo('Producto View');
    }


    public function create(User $user): bool
    {
        return $user->hasRole('Admin') || $user->hasPermissionTo('Producto Create');
    }


    public function update(User $user, Producto $producto): bool
    {
        return $user->hasRole('Admin') || $user->hasPermissionTo('Producto Update');
    }


    public function delete(User $user, Producto $producto): bool
    {
        return $user->hasRole('Admin') || $user->hasPermissionTo('Producto Delete');
    }


    public function restore(User $user, Producto $producto): bool
    {
        return false;
    }


    public function forceDelete(User $user, Producto $producto): bool
    {
        return false;
    }
}
