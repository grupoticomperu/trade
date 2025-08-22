<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Color;
use App\Models\Combustible;
use App\Models\Modello;
use App\Models\Producto;
use App\Models\Proveedor;
use App\Models\Traccion;
use App\Models\Transmision;
use App\Models\Year;
use Illuminate\Http\Request;

class ProductoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.productos.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Producto $producto)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Producto $producto)
    {
        $proveedores   = Proveedor::all();
        $brands        = Brand::all();
        $modellos      = Modello::all();
        $colors        = Color::all();
        $years         = Year::all();
        $tracciones    = Traccion::all();
        $transmisiones = Transmision::all();
        $combustibles  = Combustible::all();
        $categorias    = Category::all();

        return view('admin.productos.edit', compact(
            'producto',
            'proveedores',
            'brands',
            'modellos',
            'colors',
            'years',
            'tracciones',
            'transmisiones',
            'combustibles',
            'categorias'
        ));
    }



    public function update(Request $request, $producto)
    {

        //dd($producto);
        $producto = Producto::findOrFail($producto);
        //dd($producto);
        $data = $request->validate([
            'nombre'                     => ['nullable', 'string', 'max:255'],
            //'kilometraje'                => ['nullable', 'numeric'],
            'motor'                      => ['nullable', 'string', 'max:100'],
            'numpuertas'                 => ['nullable', 'integer', 'min:1', 'max:10'],
            'placa'                      => ['nullable', 'string', 'max:50'],

            'brand_id'                   => ['required', 'exists:brands,id'],

            'modello_id'                  => ['nullable', 'exists:modellos,id'],
            'version_id'                 => ['nullable', 'exists:versions,id'],

            'year_id'                    => ['nullable', 'exists:years,id'],
            'color_id'                   => ['nullable', 'exists:colors,id'],
            'traccion_id'                => ['nullable', 'exists:traccions,id'],
            'transmision_id'             => ['nullable', 'exists:transmisions,id'],
            'combustible_id'             => ['nullable', 'exists:combustibles,id'],
            'category_id'                => ['nullable', 'exists:categories,id'],

            'precio_venta'               => ['nullable', 'numeric'],
            'precio_esperado'            => ['nullable', 'numeric'],
            'precio_ofertado'            => ['nullable', 'numeric'],
            //'precio_compra'              => ['nullable', 'numeric'],
            'descuentos_administrativos' => ['nullable', 'numeric'],
            'descuentos_mecanicos'       => ['nullable', 'numeric'],
            //'deuda'                      => ['nullable', 'numeric'],

            'kilometraje'                => ['nullable', 'string', 'max:50'],
            'deuda'                      => ['nullable', 'string', 'max:50'],
            'bancodeuda'                 => ['nullable', 'string'],

            'state'                      => ['nullable', 'integer', 'in:0,1,2,3'], // 0=Disp,1=Vend,2=Res
            //'comprado'                   => ['nullable', 'boolean'],
            //'vendido'                    => ['nullable', 'boolean'],
        ]);

        // Normaliza checkboxes (por si faltan)
        // $data['comprado'] = $request->boolean('comprado');
        // $data['vendido']  = $request->boolean('vendido');

        $data['precio_compra'] = $data['precio_ofertado']
            - ($data['descuentos_administrativos'] ?? 0)
            - ($data['descuentos_mecanicos'] ?? 0);


        //dd($data);
        //$data['brand_id']   = (int) $data['brand_id'];
        //$data['modello_id'] = (int) $data['modello_id'];
        //$data['version_id'] = (int) $data['version_id'];


        $data['brand_id'] = $request->brandId ?: null;
        $data['modello_id'] = $request->modelloId ?: null;
        $data['version_id'] = $request->versionId ?: null;



        $producto->update($data);



        return redirect()->route('admin.crms.index')
            ->with('success', 'Producto actualizado correctamente');
    }



    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Producto $producto)
    {
        //
    }
}
