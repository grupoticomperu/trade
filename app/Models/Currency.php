<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Currency extends Model
{

    protected $guarded = ['id', 'created_at', 'updated_at'];


    //Relacion uno a muchos
    public function companies(){
        return $this->hasMany(Company::class);
    }
}
