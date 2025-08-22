<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Color;
use App\Models\Combustible;
use App\Models\Crm;
use App\Models\Distrito;
use App\Models\Etapa;
use App\Models\Lead;
use App\Models\Modello;
use App\Models\Producto;
use App\Models\Proveedor;
use App\Models\Traccion;
use App\Models\Transmision;
use App\Models\Year;
use Illuminate\Http\Request;


class CrmController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.crms.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function createe(?string $email = null, ?string $placa = null)
    {

        $req = request(); // instancia de Illuminate\Http\Request

        // 1) Prioriza segmentos de ruta; si no, toma query string
        $email = $email ?? $req->query('email');
        $placa = $placa ?? $req->query('placa');

        if (!filter_var($email, FILTER_VALIDATE_EMAIL) || empty($placa)) {
            return redirect()
                ->route('admin.leads.index') // o la vista que corresponda
                ->with([
                    'flash.banner' => 'Completa email y placa para continuar.',
                    'flash.bannerStyle' => 'danger',
                ])
                ->withInput(compact('email', 'placa'));
        }

        // 2) Mételos al request para poder usar validate() directo
        //$req->merge(compact('email', 'placa'));

        // 3) Valida (si falla, redirige atrás con errores)
        /*  $data = $req->validate([
            'email' => ['required', 'email'],
            'placa' => ['required', 'string', 'max:20'],
        ]); */

        //$proveedor = Proveedor::where('correo', $email)->first();
        $lead = Lead::where('correoelectronico', $email)->latest()->first();
        $lead->esoportunidad = true;
        $lead->save();

        $proveedor = Proveedor::firstOrNew(['correo' => $email]);

        if (!$proveedor->nombre && $lead) $proveedor->nombre = $lead->nombres;
        if (!$proveedor->telefono && $lead) $proveedor->telefono = $lead->telefono;
        //if (!$proveedor->distrito_id && $lead) $proveedor->distrito_id = $lead->distrito_id;
        //$proveedor->distrito_id = $lead->distrito_id;
        $proveedor->save();



        $brand = null;
        if ($lead && $lead->marca) {
            $brand = Brand::firstOrCreate(
                ['name' => $lead->marca],
                ['state' => 1]
            );
        }



        $year = null;
        if ($lead && $lead->anio) {
            $year = Year::firstOrCreate(
                ['name' => $lead->anio],
            );
        }


        // Buscar o crear modelo (modello) asociado a la marca
        $modelo = null;
        if ($lead && $lead->modelo && $brand) {
            $modelo = Modello::firstOrCreate(
                ['name' => $lead->modelo, 'brand_id' => $brand->id]
            );
        }





        $producto = Producto::firstOrNew(['placa' => $placa]);
        //if (!$producto->anio && $lead) $producto->anio = $lead->anio;
        if (!$producto->kilometraje && $lead) $producto->kilometraje = $lead->kilometraje;

        $producto->year_id = $year?->id;
        $producto->stock = 0;
        $producto->brand_id = $brand?->id;
        $producto->modello_id = $modelo?->id ?? null; // Asegúrate de tener el campo modelo_id
        $producto->proveedor_id = $proveedor->id;
        if (!$producto->user_id && $lead) $producto->user_id = $lead->user_id;
        $producto->save();

        //$nombrecrm = $proveedor->nombre .' '.$brand->name .' '. $modelo->name .' '. $year->name .' '. $producto->placa;
        $nombrecrm = trim(preg_replace('/\s+/', ' ', collect([
            $proveedor->nombre,
            $brand?->name,
            $modelo?->name,
            $year?->name,
            $producto->placa,
        ])->filter()->implode(' ')));

        $crmExistente = Crm::where('lead_id', $lead->id)->first();
        //$crm = Crm::where('lead_id', $lead->id)->first();

        if (!$crmExistente) {
            Crm::create([
                'nombre' => $nombrecrm,
                'proveedor_id' => $proveedor->id,
                'user_id' => $lead->user_id,
                'producto_id' => $producto->id,
                'etapa_id' => 1,
                'lead_id' => $lead->id,
                'tipomarketing_id' => $lead->tipomarketing_id,
                'fecha' => now()
            ]);
        }





        $brands = Brand::all();
        $years = Year::all();

        $modellos = Modello::all();
        $distritos = Distrito::all();
        $colores = Color::all();
        $traccions = Traccion::all();
        $transmisions = Transmision::all();
        $combustibles = Combustible::all();
        $categorias = Category::all();

        //return view('admin.crms.create', compact('proveedor', 'producto', 'nombrecrm', 'brands', 'modellos', 'years', 'distritos', 'colores', 'traccions', 'transmisions', 'combustibles', 'categorias'));

        //return view('admin.crms.index');
        return redirect()->route('admin.crms.index');
    }





    public function store(Request $request)
    {
        //
    }

    public function show(Crm $crm)
    {
        $crm->load(['proveedor', 'producto', 'etapa', 'user']);
        $etapas = Etapa::all();
        return view('admin.crms.show', compact('crm', 'etapas'));
    }

    public function update(Request $request, Crm $crm)
    {
        $request->validate([
            'etapa_id' => 'required|exists:etapas,id',
        ]);

        // Actualiza solo la etapa
        $crm->update(['etapa_id' => $request->etapa_id]);

        // Verificar si la etapa seleccionada es "ganado"
        if ($crm->etapa && strtolower($crm->etapa->name) === 'ganado') {
            if ($crm->producto) {
                $crm->producto->update([
                    'stock' => 1,
                ]);
            }
        }
        return redirect()->route('admin.crms.show', $crm)
            ->with('success', 'Etapa actualizada correctamente');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }


    public function destroy(string $id)
    {
        //
    }
}
