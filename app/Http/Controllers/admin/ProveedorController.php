<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Crm;
use App\Models\Distrito;
use App\Models\Proveedor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProveedorController extends Controller
{
   
    public function index()
    {
        return view('admin.proveedors.index');
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
    public function show(Proveedor $proveedor)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Proveedor $proveedor)
    {
        $distritos = Distrito::all();
        return view('admin.proveedors.edit', compact('proveedor', 'distritos'));
    }

    public function update(Request $request, Proveedor $proveedor)
    {


        $data = $request->validate([
            'nombre'      => ['nullable', 'string', 'max:255'],
            'telefono'    => ['nullable', 'string', 'max:50'],
            'correo'      => ['nullable', 'email', 'max:255'],
            'direccion'   => ['nullable', 'string', 'max:255'],
            'dni'         => ['nullable', 'string', 'max:20'],
            'estado'      => ['nullable', 'in:activo,inactivo'],
            'distrito_id' => ['nullable', 'exists:distritos,id'],
        ]);

        $proveedor->update($data);

        return redirect()
            ->route('admin.proveedors.index')
            ->with('status', 'Proveedor actualizado correctamente');



        /* $proveedor = Proveedor::findOrFail($proveedor);

        $data = $request->validate([
            'nombre'      => ['required', 'string', 'max:255'],
            'correo'      => ['nullable', 'email', 'max:255'],
            'direccion'   => ['nullable', 'string', 'max:255'],
            'dni'         => ['nullable', 'string', 'max:20'],
            'telefono'    => ['nullable', 'string', 'max:30'],
            'distrito_id' => ['nullable', 'exists:distritos,id'],
        ]);



        $proveedor->update($data);

        return back()->with([
            'flash.banner' => 'Proveedor Actualizado',
            'flash.bannerStyle' => 'danger', 
        ]); */
    }



    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Proveedor $proveedor)
    {
        //
    }
}
