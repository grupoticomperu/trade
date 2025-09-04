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
        Schema::create('compras', function (Blueprint $table) {
            $table->id();
            
            $table->string('numcomprobante')->nullable();
            $table->date('fecha')->nullable();
            $table->unsignedBigInteger('proveedor_id')->nullable(); 
            $table->unsignedBigInteger('user_id')->nullable(); 
            $table->unsignedBigInteger('producto_id')->nullable(); 
            $table->unsignedBigInteger('etapa_id')->nullable(); 
            
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');   
            $table->foreign('proveedor_id')->references('id')->on('proveedors')->onDelete('cascade');
            $table->foreign('producto_id')->references('id')->on('productos')->onDelete('cascade');
            $table->foreign('etapa_id')->references('id')->on('etapas')->onDelete('cascade');


            $table->double('precio')->nullable();
            $table->text('observacion')->nullable();
            $table->unsignedBigInteger('crm_id')->nullable(); 
            $table->foreign('crm_id')->references('id')->on('crms')->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('compras');
    }
};
