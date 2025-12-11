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

    //Se usa cuando el usuario intenta ver una lista completa de registros
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('Tipomarketing List');
    }

    // Se usa cuando el usuario intenta ver un registro individual por ejemplo:
    // /admin/tipomarketings/5 (detalle de un Tipomarketing específico)
    // $this->authorize('view', $tipomarketing);
    public function view(User $user, Tipomarketing $tipomarketing): bool
    {
        return $user->hasPermissionTo('Tipomarketing List');
    }


    public function create(User $user): bool
    {
        return $user->hasPermissionTo('Tipomarketing Create');
    }


    public function update(User $user, Tipomarketing $tipomarketing): bool
    {
       return $user->hasPermissionTo('Tipomarketing Update');
    }


    public function delete(User $user, Tipomarketing $tipomarketing): bool
    {
       return $user->hasPermissionTo('Tipomarketing Delete');
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
