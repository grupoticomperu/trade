<?php

namespace App\Livewire\Admin;

use App\Models\Proveedor;
use App\Models\Distrito;
use Livewire\Component;

class ProveedorCreate extends Component
{
    public $open = false;

    public $nombre = '';
    public $telefono = '';
    public $correo = '';
    public $direccion = '';
    public $dni = '';
    public $estado = 'activo';
    public $observacion = '';
    public $distrito_id = '';

    protected $rules = [
        'nombre' => 'required|string|max:150',
        'telefono' => 'nullable|string|max:20',
        'correo' => 'nullable|email|max:150',
        'direccion' => 'nullable|string|max:255',
        'dni' => 'nullable|string|max:15',
        'estado' => 'required|in:activo,inactivo',
        'distrito_id' => 'nullable|exists:distritos,id',
    ];

    public function nuevo()
    {
        $this->resetValidation();
        $this->reset([
            'nombre', 'telefono', 'correo', 'direccion', 'dni', 'estado', 'observacion', 'distrito_id'
        ]);
        $this->open = true;
    }

    public function save()
    {
        $this->validate();

        Proveedor::create([
            'nombre' => $this->nombre,
            'telefono' => $this->telefono,
            'correo' => $this->correo,
            'direccion' => $this->direccion,
            'dni' => $this->dni,
            'estado' => $this->estado,
            'observacion' => $this->observacion,
            'distrito_id' => $this->distrito_id,
        ]);

        $this->reset([
            'open', 'nombre', 'telefono', 'correo', 'direccion', 'dni', 'estado', 'observacion', 'distrito_id'
        ]);

        $this->dispatch('proveedor-creado');
        $this->dispatch('swal:success', title: 'Guardado', text: 'El proveedor se creó correctamente.');
    }

    public function render()
    {
        return view('livewire.admin.proveedor-create', [
            'distritos' => Distrito::orderBy('name')->get(),
        ]);
    }
}

