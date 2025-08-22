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
        Schema::create('proveedors', function (Blueprint $table) {
            $table->id();
            $table->string('nombre')->nullable();
            $table->string('telefono')->nullable();
            $table->string('correo')->nullable();
            $table->string('direccion')->nullable();
            $table->string('dni')->nullable();
            $table->string('estado')->default('activo'); // activo, inactivo
            $table->text('observacion')->nullable(); //aqui pondremos observaciones antes de pasar a oportuinidad o porque no paso a oportunidad
            
            $table->unsignedBigInteger('distrito_id')->nullable(); 
            $table->foreign('distrito_id')->references('id')->on('distritos')->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('proveedors');
    }
};
