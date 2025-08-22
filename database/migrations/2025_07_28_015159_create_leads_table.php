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
        Schema::create('leads', function (Blueprint $table) {
            $table->id();
            $table->date('fechaderivacion')->nullable();
            $table->date('fecha')->nullable();
            $table->string('nombres')->nullable();
            $table->string('telefono')->nullable();
            $table->string('correoelectronico')->nullable();
            $table->string('marca')->nullable();
            $table->string('modelo')->nullable();
            $table->string('anio')->nullable();
            $table->string('kilometraje')->nullable();
            $table->string('placa')->nullable();                    
            $table->boolean('state')->nullable();
            $table->boolean('esoportunidad')->default(false);
            $table->text('observacion')->nullable(); //aqui pondremos observaciones antes de pasar a oportuinidad o porque no paso a oportunidad
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->unsignedBigInteger('tipomarketing_id')->nullable();
            $table->foreign('tipomarketing_id')->references('id')->on('tipomarketings')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('leads');
    }
};
