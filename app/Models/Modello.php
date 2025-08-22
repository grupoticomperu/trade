<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Modello extends Model
{
    protected $guarded = ['id', 'created_at', 'updated_at'];

    //Relacion uno a muchos
    public function productos()
    {
        return $this->hasMany(Producto::class);
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    } 
}
