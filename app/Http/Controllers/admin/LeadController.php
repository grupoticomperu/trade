<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Lead;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Tipomarketing;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests; // Importar el trait

use App\Imports\LeadsImport;
use Maatwebsite\Excel\Facades\Excel;


//php artisan make:controller admin\LeadController --model=Lead --resource
class LeadController extends Controller
{
    use AuthorizesRequests; // Usa el trait aquí explícitamente

    public function index()
    {
        return view('admin.leads.index');
    }


    public function create()
    {
        $this->authorize('create', $lead = new Lead);
        $users = User::all();
        $tipomarketings = Tipomarketing::all();
        return view('admin.leads.create', compact('users', 'tipomarketings'));
    }


    public function store(Request $request)
    {
        $validated = $request->validate([
            'fechaderivacion' => 'nullable|date',
            'fecha' => 'nullable|date',
            'nombres' => 'nullable|string|max:255',
            'telefono' => 'nullable|string|max:255',
            'correoelectronico' => 'nullable|email|max:255',
            'marca' => 'nullable|string|max:255',
            'modelo' => 'nullable|string|max:255',
            'anio' => 'nullable|string|max:255',
            'kilometraje' => 'nullable|string|max:255',
            'placa' => 'nullable|string|max:255',
            'observacion' => 'nullable',
            'state' => 'nullable|boolean',
            'user_id' => 'nullable|exists:users,id',
            'tipomarketing_id' => 'nullable|exists:tipomarketings,id',
        ]);

        Lead::create($validated);

        return redirect()->route('admin.leads.create')->with('success', 'Lead creado correctamente');
    }


    public function show(Lead $lead)
    {
        //
    }

  
    public function edit(Lead $lead)
    {
        $users = User::all();
        $tipomarketings = Tipomarketing::all();
        return view('admin.leads.edit', compact('lead', 'users', 'tipomarketings'));
    }


    public function update(Request $request, Lead $lead)
    {
        $validated = $request->validate([
            'fechaderivacion'     => 'nullable|date',
            'fecha'               => 'nullable|date',
            'nombres'             => 'nullable|string',
            'telefono'            => 'nullable|string',
            'correoelectronico'   => 'nullable|email',
            'marca'               => 'nullable|string',
            'modelo'              => 'nullable|string',
            'anio'                => 'nullable|string',
            'kilometraje'         => 'nullable|string',
            'placa'               => 'nullable|string',
            'observacion'         => 'nullable',
            'state'               => 'nullable|boolean',
            'user_id'             => 'nullable|exists:users,id',
            'tipomarketing_id'    => 'nullable|exists:tipomarketings,id',
        ]);

        $lead->update($validated);

        session()->flash('swal', [
            'icon' => 'succes',
            'title' => 'Bien Hecho',
            'text' => 'Usuario Actualizado Correctamente',
        ]);

        return redirect()->route('admin.leads.index')->with('success', 'Lead actualizado correctamente.');
    }





    public function destroy(Lead $lead)
    {
        //
    }


    public function Form()
    {
        return view('admin.leads.import');
    }

    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,csv',
        ]);

        try {
            Excel::import(new LeadsImport, $request->file('file'));
            return back()->with('success', 'Leads importados correctamente.');
        } catch (\Exception $e) {
            return back()->withErrors(['file' => 'Error al importar el archivo: ' . $e->getMessage()]);
        }
    }
}
