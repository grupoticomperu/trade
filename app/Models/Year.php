<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Year extends Model
{

        use HasFactory;
        protected $fillable = [
                'name',
        ];

        //Relacion uno a muchos
        public function productos()
        {
                return $this->hasMany(Producto::class);
        }


        protected $casts = [
                'created_at' => 'datetime',
                'updated_at' => 'datetime',
        ];
}
