<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Multitenancy\Models\Tenant as BaseTenant;

class Tenant extends BaseTenant
{
    use HasFactory;
    // Agrega aquí cualquier lógica personalizada para el inquilino
    public static function defaultTenant()
    {
        return static::where('name', 'localhost')->first(); // Ajusta el criterio si es necesario
    }
}