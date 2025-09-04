<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Crm;
use App\Models\Seguimiento;
use Illuminate\Http\Request;

class SeguimientoController extends Controller
{
    // Lista todos los seguimientos de un CRM y muestra form para agregar uno
    public function index(Crm $crm)
    {
        //$seguimientos = $crm->seguimientos()->orderByDesc('fecha')->get();

        $seguimientos = $crm->seguimientos()
            ->orderByDesc('fecha')
            ->orderByDesc('id')
            ->get();

        return view('admin.seguimientos.index', compact('crm', 'seguimientos'));
    }


    // Crea un seguimiento para el CRM
    public function store(Request $request, Crm $crm)
    {
        $data = $request->validate([
            'nombre' => ['required', 'string', 'max:255'],
            'fecha'  => ['required', 'date'],
        ]);

        $crm->seguimientos()->create($data);

        return back()->with('status', 'Seguimiento creado.');
    }


    // Form de edición (ruta shallow)
    public function edit(Seguimiento $seguimiento)
    {
         $seguimiento->load('crm'); // belongsTo
        return view('admin.seguimientos.edit', compact('seguimiento'));
    }

    // Actualiza (ruta shallow)
    public function update(Request $request, Seguimiento $seguimiento)
    {
        $data = $request->validate([
            'nombre' => ['required', 'string', 'max:255'],
            'fecha'  => ['required', 'date'],
        ]);

        $seguimiento->update($data);

        return redirect()
            ->route('admin.crms.seguimientos.index', $seguimiento->crm_id)
            ->with('status', 'Seguimiento actualizado.');
    }

    // Elimina (ruta shallow)
    public function destroy(Seguimiento $seguimiento)
    {
        $crmId = $seguimiento->crm_id;
        $seguimiento->delete();

        return redirect()
            ->route('admin.crms.seguimientos.index', $crmId)
            ->with('status', 'Seguimiento eliminado.');
    }
}
