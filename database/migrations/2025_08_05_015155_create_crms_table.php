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
        Schema::create('crms', function (Blueprint $table) {
            $table->id();
            $table->string('nombre')->nullable();
            $table->unsignedBigInteger('proveedor_id')->nullable(); 
            $table->unsignedBigInteger('user_id')->nullable(); 
            $table->unsignedBigInteger('producto_id')->nullable(); 
            $table->unsignedBigInteger('etapa_id')->nullable(); 
            $table->unsignedBigInteger('lead_id')->nullable(); 
            $table->unsignedBigInteger('tipomarketing_id')->nullable(); 
            $table->date('fechaderivacion')->nullable();
            $table->date('fecha')->nullable();
            $table->date('fechaoportunidad')->nullable();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            
            $table->foreign('proveedor_id')->references('id')->on('proveedors')->onDelete('cascade');
            $table->foreign('producto_id')->references('id')->on('productos')->onDelete('cascade');
            $table->foreign('etapa_id')->references('id')->on('etapas')->onDelete('cascade');
            $table->foreign('lead_id')->references('id')->on('leads')->onDelete('cascade');
            $table->foreign('tipomarketing_id')->references('id')->on('tipomarketings')->onDelete('cascade');



            

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('crms');
    }
};
