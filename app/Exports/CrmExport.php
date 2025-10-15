<?php

namespace App\Exports;

use App\Models\Crm;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class CrmExport implements FromCollection, WithHeadings, WithMapping
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        // Cargamos las relaciones necesarias para evitar el N+1
        return Crm::with(['producto.brand', 
                          'producto.brand', 
                          'producto.modello', 
                          'producto.version', 
                          'producto.year', 
                          'proveedor', 
                          'user',
                          'tipomarketing'
                        ])->get();
    }

    public function headings(): array
    {
        return [
            'ID',
            'Fecha Derivación',
            'Fecha',
            'Campaña',
            'Deuda',
            'Banco',
            //'Nombre CRM',
            'Nombre',
            'Celular',
            'correo',
            'Distrito',
            'Asesor',
            //'Fecha',
            'Placa',
            'Marca',
            'Modelo',
            'Versión',
            'Año',
            'Kilometraje',
            'precio_venta',
            'precio_esperado',
            'precio_ofertado',

            'Etapa',
            'Producto',                               
            'Precio Venta',
            'Estado',
           
        ];
    }


    public function map($crm): array
    {
        $producto = $crm->producto;

        return [
            $crm->id,
            $crm->fechaderivacion,
            $crm->fecha,
            optional($crm->tipomarketing)->name,
            optional($producto)->deuda,
            optional($producto)->bancodeuda,
            //$crm->nombre,
            optional($crm->proveedor)->nombre,
            optional($crm->proveedor)->telefono,
            optional($crm->proveedor)->correo,
            optional($crm->proveedor->distrito)->name,
            optional($crm->user)->name,
            //$crm->fecha,
            optional($producto)->placa,
            optional($producto->brand)->nombre,
            optional($producto->modello)->nombre,
            optional($producto->version)->nombre,
            optional($producto->year)->nombre,
            optional($producto)->kilometraje,   
            optional($producto)->precio_venta,  
            optional($producto)->precio_esperado, 
            optional($producto)->precio_ofertado, 

                     


            optional($crm->etapa)->name,
            optional($producto)->nombre,
                                          
            
            optional($producto)->precio_venta,
            $crm->state ? 'Activo' : 'Inactivo',
         
        ];
    }


}
