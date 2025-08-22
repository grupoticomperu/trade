<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Seguimiento extends Model
{

    protected $fillable = ['nombre', 'fecha', 'crm_id'];
    protected $casts = ['fecha' => 'date'];

    // Un seguimiento pertenece a un crm
    public function crm()
    {
        return $this->belongsTo(Crm::class);
    }
}
