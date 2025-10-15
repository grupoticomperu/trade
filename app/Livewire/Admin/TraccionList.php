<?php

namespace App\Livewire\Admin;

use App\Models\Traccion;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Computed;
use Livewire\Attributes\On;
use Livewire\Attributes\Lazy;

class TraccionList extends Component
{
    use WithPagination;

    public $search = '';
    public $sort = 'id';
    public $direction = 'desc';
    public $cant = 10;

    public $open_edit = false;
    public $traccion_id;
    public $name;

    #[On('traccion-creado')]
    public function actualizarLista()
    {
        $this->resetPage();
    }

    #[Computed]
    #[Lazy]
    public function traccions()
    {
        $query = Traccion::query();

        if ($this->search) {
            $query->where('name', 'like', "%{$this->search}%");
        }

        return $query
            ->orderBy($this->sort, $this->direction)
            ->paginate($this->cant);
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

    // Abrir modal de edición
    public function edit($id)
    {
        $traccion = Traccion::findOrFail($id);
        $this->traccion_id = $traccion->id;
        $this->name = $traccion->name;
        $this->open_edit = true;
    }

    public function cancelar()
    {
        $this->reset(['open_edit', 'traccion_id', 'name']);
        $this->resetValidation();
    }

    // Actualizar
    public function update()
    {
        $this->validate([
            'name' => 'required|string|min:2|max:150|unique:traccions,name,' . $this->traccion_id,
        ]);

        $traccion = Traccion::find($this->traccion_id);
        $traccion->update(['name' => $this->name]);

        $this->reset(['open_edit', 'traccion_id', 'name']);
        $this->dispatch('swal:success', title: 'Actualizado', text: 'La tracción fue modificada correctamente.');
    }

    // Confirmar eliminación
    public function confirmarEliminado($id)
    {
        $this->dispatch('confirmareliminadooo', message: '¿Estás seguro de eliminar este registro?', id: $id);
        $this->traccion_id = $id;
    }

    #[On('eliminar')]
    public function eliminar()
    {
        $traccion = Traccion::find($this->traccion_id);
        if ($traccion) {
            $traccion->delete();
            $this->dispatch('swal:success', title: 'Eliminado', text: 'La tracción fue eliminada correctamente.');
        }
    }

    public function render()
    {
        return view('livewire.admin.traccion-list', [
            'traccions' => $this->traccions,
        ])->layout('layouts.app');
    }
}
