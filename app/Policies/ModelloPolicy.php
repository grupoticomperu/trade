<?php

namespace App\Policies;

use App\Models\Modello;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ModelloPolicy
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
     * Determina si el usuario puede ver cualquier modelo
     */
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('Modello List');
    }

    /**
     * Determina si el usuario puede ver un modelo específico
     */
    public function view(User $user, Modello $modello): bool
    {
        return $user->hasPermissionTo('Modello View');
    }

    /**
     * Determina si el usuario puede crear modelos
     */
    public function create(User $user): bool
    {
        return $user->hasPermissionTo('Modello Create');
    }

    /**
     * Determina si el usuario puede actualizar un modelo
     */
    public function update(User $user, Modello $modello): bool
    {
        return $user->hasPermissionTo('Modello Update');
    }

    /**
     * Determina si el usuario puede eliminar un modelo
     */
    public function delete(User $user, Modello $modello): bool
    {
        return $user->hasPermissionTo('Modello Delete');
    }

    /**
     * Determina si el usuario puede restaurar un modelo
     */
    public function restore(User $user, Modello $modello): bool
    {
        return false;
    }

    /**
     * Determina si el usuario puede eliminar permanentemente un modelo
     */
    public function forceDelete(User $user, Modello $modello): bool
    {
        return false;
    }
}
