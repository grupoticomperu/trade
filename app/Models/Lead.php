<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

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
}
