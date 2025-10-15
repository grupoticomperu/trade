<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('traccions', function (Blueprint $table) {
            $table->id();
            $table->string('name', 150) //Reducirlo ayuda a optimizar el tamaño de la tabla en memoria y disco.
                ->unique() //no es necesario poner index porque unique ya lo crea
                ->collation('utf8mb4_unicode_ci');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('traccions');
    }
};
