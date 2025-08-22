<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Proveedor extends Model
{

    protected $guarded = ['id', 'created_at', 'updated_at'];

    public function crms()
    {
        return $this->hasMany(Crm::class);
    }

    public function productos()
    {
        return $this->hasMany(Producto::class);
    }


}
