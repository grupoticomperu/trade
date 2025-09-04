<?php

namespace App\Policies;

use App\Models\Tipomarketing;
use App\Models\User;
use Illuminate\Auth\Access\Response;
use Illuminate\Auth\Access\HandlesAuthorization; //agregue esto

class TipomarketingPolicy
{

    //agregue esto, chat gpt recomienda ponerlo
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
        return false;
    }


    public function view(User $user, Tipomarketing $tipomarketing): bool
    {
        return false;
    }


    public function create(User $user): bool
    {
        return false;
    }


    public function update(User $user, Tipomarketing $tipomarketing): bool
    {
        return false;
    }


    public function delete(User $user, Tipomarketing $tipomarketing): bool
    {
        return false;
    }


    public function restore(User $user, Tipomarketing $tipomarketing): bool
    {
        return false;
    }


    public function forceDelete(User $user, Tipomarketing $tipomarketing): bool
    {
        return false;
    }
}
