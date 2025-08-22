<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Crm extends Model
{

    protected $guarded = ['id', 'created_at', 'updated_at'];

    public function proveedor()
    {
        return $this->belongsTo(Proveedor::class);
    }


    // Un lead pertenece a un tipo de marketing
    public function tipomarketing()
    {
        return $this->belongsTo(Tipomarketing::class);
    }


    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function producto()
    {
        return $this->belongsTo(Producto::class);
    }

    public function etapa()
    {
        return $this->belongsTo(Etapa::class);
    }

    // Un crm tiene muchos seguimientos
    public function seguimientos()
    {
        return $this->hasMany(Seguimiento::class);
    }


}
