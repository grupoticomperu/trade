<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

//php artisan make:model Version -m
class Version extends Model
{
    protected $guarded = ['id', 'created_at', 'updated_at'];


    public function modello()
    {
        return $this->belongsTo(Modello::class);
    }

    public function productos()
    {
        return $this->hasMany(Producto::class);
    }
}
