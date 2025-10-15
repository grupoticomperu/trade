<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Combustible extends Model
{
        protected $fillable = ['name'];

    //Relacion uno a muchos
    public function productos(){
        return $this->hasMany(Producto::class);
    }
}
