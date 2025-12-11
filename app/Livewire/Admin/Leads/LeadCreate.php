<?php

namespace App\Livewire\Admin\Leads;

use Livewire\Component;

use App\Models\Lead;
use App\Models\User;
use App\Models\Tipomarketing;
use App\Models\Brand;
use App\Models\Modello;
use App\Models\Version;



class LeadCreate extends Component
{


    public $fechaderivacion, $fecha, $nombres, $telefono, $correoelectronico;
    public $brand_id, $modello_id, $version_id;
    public $anio, $kilometraje, $placa, $observacion;
    public $state, $user_id, $tipomarketing_id;
    public $perfilcoincide;

    public $modellos = [];
    public $versions = [];

    // 🔹 Cuando cambia la marca, cargamos los modelos asociados
    public function updatedBrandId($value)
    {
        $this->modellos = Modello::where('brand_id', $value)->get();
        $this->modello_id = null;
        $this->versions = [];
    }

    // 🔹 Cuando cambia el modelo, cargamos las versiones asociadas
    public function updatedModelloId($value)
    {
        $this->versions = Version::where('modello_id', $value)->get();
        $this->version_id = null;
    }

    // 🔹 Reglas de validación
    protected $rules = [
        'fechaderivacion' => 'required|date',
        'fecha' => 'required|date',
        'nombres' => 'required|string|max:255',
        'telefono' => 'required|string|max:255',
        'correoelectronico' => 'required|email|max:255',
        'brand_id' => 'required|exists:brands,id',
        'modello_id' => 'required|exists:modellos,id',
        //'version_id' => 'required|exists:versions,id',
        'anio' => 'required|string|max:255',
        'kilometraje' => 'required|string|max:255',
        'placa' => 'required|string|max:255',
        //'state' => 'required|boolean',
        'user_id' => 'required|exists:users,id',
        'tipomarketing_id' => 'required|exists:tipomarketings,id',
        'observacion' => 'nullable|string',
    ];

    // 🔹 Mensajes personalizados
    protected $messages = [
        'fechaderivacion.required' => 'La fecha de derivación es obligatoria.',
        'fechaderivacion.date' => 'Debe ingresar una fecha válida.',
        'fecha.required' => 'La fecha es obligatoria.',
        'fecha.date' => 'Debe ingresar una fecha válida.',
        'nombres.required' => 'El campo nombres es obligatorio.',
        'telefono.required' => 'El campo teléfono es obligatorio.',
        'correoelectronico.required' => 'El correo electrónico es obligatorio.',
        'correoelectronico.email' => 'Debe ingresar un correo electrónico válido.',
        'brand_id.required' => 'Debe seleccionar una marca.',
        'brand_id.exists' => 'La marca seleccionada no es válida.',
        'modello_id.required' => 'Debe seleccionar un modelo.',
        'modello_id.exists' => 'El modelo seleccionado no es válido.',
        //'version_id.required' => 'Debe seleccionar una versión.',
        //'version_id.exists' => 'La versión seleccionada no es válida.',
        'anio.required' => 'El campo año es obligatorio.',
        'kilometraje.required' => 'El campo kilometraje es obligatorio.',
        'placa.required' => 'El campo placa es obligatorio.',
        //'state.required' => 'Debe seleccionar un estado (activo o inactivo).',
        'user_id.required' => 'Debe seleccionar un usuario responsable.',
        'user_id.exists' => 'El usuario seleccionado no es válido.',
        'tipomarketing_id.required' => 'Debe seleccionar un tipo de marketing.',
        'tipomarketing_id.exists' => 'El tipo de marketing seleccionado no es válido.',
    ];

    // 🔹 Validación en tiempo real
    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    // 🔹 Guardar Lead
    public function save()
    {
        $validated = $this->validate();
        //dd('llego');

        Lead::create([
            'fechaderivacion' => $this->fechaderivacion,
            'fecha' => $this->fecha,
            'nombres' => $this->nombres,
            'telefono' => $this->telefono,
            'correoelectronico' => $this->correoelectronico,
            'marca' => Brand::find($this->brand_id)?->name,
            'modelo' => Modello::find($this->modello_id)?->name,
            'anio' => $this->anio,
            'kilometraje' => $this->kilometraje,
            'placa' => $this->placa,
            'observacion' => $this->observacion,
            'state' => 1,
            'user_id' => $this->user_id,
            'tipomarketing_id' => $this->tipomarketing_id,
            'perfilcoincide' => $this->perfilcoincide,
        ]);

        session()->flash('swal', [
            'icon' => 'success',
            'title' => 'Bien hecho',
            'text' => 'Lead creado correctamente.',
        ]);

        return redirect()->route('admin.leads.index');
    }

    // 🔹 Renderizar vista
    public function render()
    {
        return view('livewire.admin.leads.lead-create', [
            'users' => User::all(),
            'tipomarketings' => Tipomarketing::all(),
            'brands' => Brand::all(),
        ]);
    }





  
}
