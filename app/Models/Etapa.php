<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Etapa extends Model
{
    protected $guarded = ['id', 'created_at', 'updated_at'];

    public function crms()
    {
        return $this->hasMany(Crm::class);
    }
}
