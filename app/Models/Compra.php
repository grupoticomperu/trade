<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Compra extends Model
{
    protected $guarded = ['id', 'created_at', 'updated_at'];

    public function crm()
    {
        return $this->belongsTo(Crm::class);
    }
    public function proveedor()
    {
        return $this->belongsTo(Proveedor::class);
    }
    public function producto()
    {
        return $this->belongsTo(Producto::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function etapa()
    {
        return $this->belongsTo(\App\Models\Etapa::class); 
    }

    // app/Models/Compra.php
    protected $casts = [
        'fecha' => 'date',
        'precio' => 'decimal:2',
    ];
}
