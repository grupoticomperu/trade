<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Local extends Model
{
    protected $guarded = ['id', 'created_at', 'updated_at'];

    public function employees()
    {
        return $this->hasMany(Employee::class);
    }
}
