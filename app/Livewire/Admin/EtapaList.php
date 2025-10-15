<?php

namespace App\Livewire\Admin;

use App\Models\Etapa;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Computed;
use Livewire\Attributes\On;
use Livewire\Attributes\Lazy;

class EtapaList extends Component
{
    use WithPagination;

    public $search = '';
    public $sort = 'id';
    public $direction = 'desc';
    public $cant = 10;

    public $open_edit = false;
    public $etapa_id;
    public $name;
    public $order;

    #[On('etapa-creado')]
    public function actualizarLista()
    {
        $this->resetPage();
    }

    #[Computed]
    #[Lazy]
    public function etapas()
    {
        $query = Etapa::query();

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
        $etapa = Etapa::findOrFail($id);
        $this->etapa_id = $etapa->id;
        $this->name = $etapa->name;
        $this->order = $etapa->order;
        $this->open_edit = true;
    }

    public function cancelar()
    {
        $this->reset(['open_edit', 'etapa_id', 'name', 'order']);
        $this->resetValidation();
    }

    // Actualizar etapa
    public function update()
    {
        $this->validate([
            'name' => 'required|string|min:2|max:150|unique:etapas,name,' . $this->etapa_id,
            'order' => 'nullable|integer|min:1|max:999',
        ]);

        $etapa = Etapa::find($this->etapa_id);
        $etapa->update([
            'name' => $this->name,
            'order' => $this->order,
        ]);

        $this->reset(['open_edit', 'etapa_id', 'name', 'order']);
        $this->dispatch('swal:success', title: 'Actualizado', text: 'La etapa fue modificada correctamente.');
    }

    // Confirmar eliminación
    public function confirmarEliminado($id)
    {
        $this->dispatch('confirmareliminadooo', message: '¿Estás seguro de eliminar este registro?', id: $id);
        $this->etapa_id = $id;
    }

    #[On('eliminar')]
    public function eliminar()
    {
        $etapa = Etapa::find($this->etapa_id);
        if ($etapa) {
            $etapa->delete();
            $this->dispatch('swal:success', title: 'Eliminado', text: 'La etapa fue eliminada correctamente.');
        }
    }

    public function render()
    {
        return view('livewire.admin.etapa-list', [
            'etapas' => $this->etapas,
        ])->layout('layouts.app');
    }
}
