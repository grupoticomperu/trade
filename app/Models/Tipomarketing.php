<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tipomarketing extends Model
{
    protected $fillable = ['name','order',];

    // Un tipo de marketing puede tener muchos leads
    public function leads()
    {
        return $this->hasMany(Lead::class);
    }
   
    public function crms()
    {
        return $this->hasMany(Crm::class);
    }


}
