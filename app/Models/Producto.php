<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    protected $guarded = ['id', 'created_at', 'updated_at'];

    public function crms()
    {
        return $this->hasMany(Crm::class);
    }

    //Relacion uno a muhos inversa
    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    public function modello()
    {
        return $this->belongsTo(Modello::class);
    }

    public function version()
    {
        return $this->belongsTo(Version::class);
    }

    public function color()
    {
        return $this->belongsTo(Color::class);
    }

    public function combustible()
    {
        return $this->belongsTo(Combustible::class);
    }

    public function transmision()
    {
        return $this->belongsTo(Transmision::class);
    }

    public function traccion()
    {
        return $this->belongsTo(Traccion::class);
    }

    public function year()
    {
        return $this->belongsTo(Year::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function proveedor()
    {
        return $this->belongsTo(Proveedor::class);
    }
}
