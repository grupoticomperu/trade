<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Carbon\Carbon;

class Lead extends Model
{
    protected $fillable = [
        'fechaderivacion',
        'fecha',
        'nombres',
        'telefono',
        'correoelectronico',
        'marca',
        'modelo',
        'anio',
        'kilometraje',
        'placa',
        'observacion',
        'state',
        'perfilcoincide',
        'user_id',
        'tipomarketing_id',
    ];

    const STATE_INACTIVE = 0;
    const STATE_ACTIVE = 1;


    // Un lead pertenece a un tipo de marketing
    public function tipomarketing()
    {
        return $this->belongsTo(Tipomarketing::class);
    }

    // Un lead también pertenece a un usuario
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // App\Models\Lead.php
    protected $casts = [
        'state'         => 'boolean',
        'esoportunidad' => 'boolean',
        'fecha' => 'date:d/m/Y',
        'fechaderivacion' => 'date:d/m/Y',
    ];


    // App\Models\Lead.php
    public function scopeNoOportunidad($q)
    {
        return $q->where('esoportunidad', 0);
    }


    /*  protected function fechaderivacion(): Attribute
    {
        return Attribute::make(
            get: fn($value) => \Carbon\Carbon::parse($value)->format('m/d/Y'),
        );
    } */

    /* protected function fechaderivacion(): Attribute
    {
        return Attribute::make(
            get: fn($value) => Carbon::parse($value)->translatedFormat('d/m/Y'),
        );
    } */

    protected function fechaderivacion(): Attribute
    {
        return Attribute::make(
            get: fn($value) =>
            $value ? Carbon::parse($value)->translatedFormat('d/m/Y') : null,
        );
    }

    /*  protected function fechaderivacion(): Attribute
    {
        return Attribute::make(
            get: fn($value) => Carbon::parse($value)->locale('es')->translatedFormat('d \d\e F \d\e Y'),
        );
    } */


    /* protected function fecha(): Attribute
    {
        return Attribute::make(
            get: fn($value) => Carbon::parse($value)->locale('es')->translatedFormat('d \d\e F \d\e Y'),
        );
    } */


    /*  protected function fecha(): Attribute
    {
        return Attribute::make(
            get: fn($value) => \Carbon\Carbon::parse($value)->format('m/d/Y'),
        );
    } */

    /* protected function fecha(): Attribute
    {
        return Attribute::make(
            get: fn($value) => Carbon::parse($value)->translatedFormat('d/m/Y'),
        );
    } */

    protected function fecha(): Attribute
    {
        return Attribute::make(
            get: fn($value) =>
            $value ? Carbon::parse($value)->translatedFormat('d/m/Y') : null,
        );
    }
}
