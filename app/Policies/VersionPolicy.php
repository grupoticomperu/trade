<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Version;
use Illuminate\Auth\Access\HandlesAuthorization;

class VersionPolicy
{
    use HandlesAuthorization;

    /**
     * Permitir todo si el usuario es administrador
     */
    public function before($user)
    {
        if ($user->hasRole('Admin')) {
            return true;
        }
    }

    /**
     * Determina si el usuario puede ver cualquier versión
     */
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('Version List');
    }

    /**
     * Determina si el usuario puede ver una versión específica
     */
    public function view(User $user, Version $version): bool
    {
        return $user->hasPermissionTo('Version View');
    }

    /**
     * Determina si el usuario puede crear versiones
     */
    public function create(User $user): bool
    {
        return $user->hasPermissionTo('Version Create');
    }

    /**
     * Determina si el usuario puede actualizar una versión
     */
    public function update(User $user, Version $version): bool
    {
        return $user->hasPermissionTo('Version Update');
    }

    /**
     * Determina si el usuario puede eliminar una versión
     */
    public function delete(User $user, Version $version): bool
    {
        return $user->hasPermissionTo('Version Delete');
    }

    /**
     * Determina si el usuario puede restaurar una versión
     */
    public function restore(User $user, Version $version): bool
    {
        return false;
    }

    /**
     * Determina si el usuario puede eliminar permanentemente una versión
     */
    public function forceDelete(User $user, Version $version): bool
    {
        return false;
    }
}
