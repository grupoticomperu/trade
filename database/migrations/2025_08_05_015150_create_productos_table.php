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
        Schema::create('productos', function (Blueprint $table) {
            $table->id();
            $table->string('nombre')->nullable();
            //$table->string('descripcion')->nullable();
            $table->string('kilometraje')->nullable();
            $table->string('transmision')->nullable();
            $table->string('combustible')->nullable();
            $table->string('motor')->nullable();
            $table->integer('numpuertas')->nullable();
            $table->integer('stock')->default(0);
            $table->string('placa')->nullable();
            //$table->boolean('comprado')->default(false);
            //$table->boolean('vendido')->default(false);

            $table->double('precio_venta')->nullable();
            $table->double('precio_esperado')->nullable();
            $table->double('precio_ofertado')->nullable();
            $table->string('deuda')->nullable();
            $table->string('bancodeuda')->nullable();
            $table->string('imagen')->nullable(); // Ruta de la imagen del producto
            //$table->string('state')->default('0'); // disponible, vendido, reservado

            $table->unsignedTinyInteger('state')
                ->default(0)
                ->comment('0=Disp,1=Res,2=Vend,3=Comp');

            $table->double('descuentos_administrativos')->nullable();
            $table->double('descuentos_mecanicos')->nullable();
            $table->double('precio_compra')->nullable();

            $table->unsignedBigInteger('proveedor_id')->nullable();
            $table->unsignedBigInteger('user_id')->nullable(); // Vendedor o usuario asociado
            $table->unsignedBigInteger('brand_id')->nullable(); // Marca del vehículo
           // $table->unsignedBigInteger('modello_id')->nullable(); // Marca del vehículo
           //  $table->unsignedBigInteger('version_id')->nullable(); // Marca del vehículo
            $table->unsignedBigInteger('color_id')->nullable(); // Color del vehículo       
            $table->unsignedBigInteger('year_id')->nullable(); // Color del vehículo  
            $table->unsignedBigInteger('traccion_id')->nullable(); // Color del vehículo  
            $table->unsignedBigInteger('transmision_id')->nullable(); // Color del vehículo  
            $table->unsignedBigInteger('combustible_id')->nullable(); // Color del vehículo 
            $table->unsignedBigInteger('category_id')->nullable(); // Color del vehículo 

            $table->decimal('precio', 10, 2)->nullable();
            $table->foreign('proveedor_id')->references('id')->on('proveedors')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('brand_id')->references('id')->on('brands')->onDelete('cascade');
            //$table->foreign('modello_id')->references('id')->on('modellos')->onDelete('cascade');
            //$table->foreign('version_id')->references('id')->on('versions')->onDelete('cascade');

            $table->foreignId('modello_id')->nullable()->constrained()->onDelete('cascade');
            $table->foreignId('version_id')->nullable()->constrained()->onDelete('cascade');

            $table->foreign('color_id')->references('id')->on('colors')->onDelete('cascade');
            $table->foreign('year_id')->references('id')->on('years')->onDelete('cascade');
            $table->foreign('traccion_id')->references('id')->on('traccions')->onDelete('cascade');
            $table->foreign('transmision_id')->references('id')->on('transmisions')->onDelete('cascade');
            $table->foreign('combustible_id')->references('id')->on('combustibles')->onDelete('cascade');
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');


            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('productos');
    }
};
