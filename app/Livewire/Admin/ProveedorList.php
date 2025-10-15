<?php

namespace App\Livewire\Admin;

use App\Models\Proveedor;
use App\Models\Distrito;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Computed;
use Livewire\Attributes\On;
use Livewire\Attributes\Lazy;

class ProveedorList extends Component
{
    use WithPagination;

    public $search = '';
    public $sort = 'id';
    public $direction = 'desc';
    public $cant = 10;

    public $open_edit = false;

    // Campos de edición
    public $proveedor_id;
    public $nombre = '';
    public $telefono = '';
    public $correo = '';
    public $direccion = '';
    public $dni = '';
    public $estado = 'activo';
    public $observacion = '';
    public $distrito_id = '';

    #[On('proveedor-creado')]
    public function actualizarLista()
    {
        $this->resetPage();
    }

    #[Computed]
    #[Lazy]
    public function proveedors()
    {
        $query = Proveedor::with('distrito');

        if ($this->search) {
            $query->where(function ($q) {
                $q->where('nombre', 'like', "%{$this->search}%")
                    ->orWhere('telefono', 'like', "%{$this->search}%")
                    ->orWhere('correo', 'like', "%{$this->search}%")
                    ->orWhereHas('distrito', function ($d) {
                        $d->where('name', 'like', "%{$this->search}%");
                    });
            });
        }

        switch ($this->sort) {
            case 'distrito_name':
                $query->orderBy(
                    Distrito::select('name')
                        ->whereColumn('distritos.id', 'proveedors.distrito_id')
                        ->limit(1),
                    $this->direction
                );
                break;

            default:
                $query->orderBy($this->sort, $this->direction);
                break;
        }

        return $query->paginate($this->cant);
    }

    #[Computed]
    public function distritos()
    {
        return Distrito::orderBy('name')->get();
    }

    public function order($field)
    {
        if ($this->sort === $field) {
            $this->direction = $this->direction === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sort = $field;
            $this->direction = 'asc';
        }
    }

    // Editar
    public function edit($id)
    {
        $prov = Proveedor::findOrFail($id);

        $this->proveedor_id = $prov->id;
        $this->nombre = $prov->nombre;
        $this->telefono = $prov->telefono;
        $this->correo = $prov->correo;
        $this->direccion = $prov->direccion;
        $this->dni = $prov->dni;
        $this->estado = $prov->estado;
        $this->observacion = $prov->observacion;
        $this->distrito_id = $prov->distrito_id;

        $this->open_edit = true;
    }

    public function cancelar()
    {
        $this->reset([
            'open_edit', 'proveedor_id', 'nombre', 'telefono', 'correo',
            'direccion', 'dni', 'estado', 'observacion', 'distrito_id'
        ]);
        $this->resetValidation();
    }

    public function update()
    {
        $this->validate([
            'nombre' => 'required|string|max:150',
            'telefono' => 'nullable|string|max:20',
            'correo' => 'nullable|email|max:150',
            'direccion' => 'nullable|string|max:255',
            'dni' => 'nullable|string|max:15',
            'estado' => 'required|in:activo,inactivo',
            'distrito_id' => 'nullable|exists:distritos,id',
        ]);

        $prov = Proveedor::find($this->proveedor_id);

        if ($prov) {
            $prov->update([
                'nombre' => $this->nombre,
                'telefono' => $this->telefono,
                'correo' => $this->correo,
                'direccion' => $this->direccion,
                'dni' => $this->dni,
                'estado' => $this->estado,
                'observacion' => $this->observacion,
                'distrito_id' => $this->distrito_id,
            ]);

            $this->cancelar();
            $this->dispatch('swal:success', title: 'Actualizado', text: 'El proveedor fue modificado correctamente.');
        }
    }

    // Eliminar
    public function confirmarEliminado($id)
    {
        $this->dispatch('confirmareliminadooo', message: '¿Deseas eliminar este proveedor?', id: $id);
        $this->proveedor_id = $id;
    }

    #[On('eliminar')]
    public function eliminar()
    {
        $prov = Proveedor::find($this->proveedor_id);
        if ($prov) {
            $prov->delete();
            $this->dispatch('swal:success', title: 'Eliminado', text: 'Proveedor eliminado correctamente.');
        }
    }

    public function render()
    {
        return view('livewire.admin.proveedor-list', [
            'proveedors' => $this->proveedors,
            'distritos' => $this->distritos,
        ])->layout('layouts.app');
    }
}
