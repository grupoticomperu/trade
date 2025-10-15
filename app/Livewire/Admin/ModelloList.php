<?php

namespace App\Livewire\Admin;

use App\Models\Modello;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Computed;
use Livewire\Attributes\On;
use Livewire\Attributes\Lazy;

class ModelloList extends Component
{
    use WithPagination;

    public $search = '';
    public $sort = 'id';
    public $direction = 'desc';
    public $cant = 10;

    public $open_edit = false;
    public $modello_id;
    public $name;
    public $brand_id;

    #[On('modello-creado')]
    public function actualizarLista()
    {
        $this->resetPage();
    }

    #[Computed]
    #[Lazy]
    public function modellos()
    {
        $query = Modello::with('brand');

        if ($this->search) {
            $query->where('name', 'like', "%{$this->search}%")
                ->orWhereHas('brand', function ($q) {
                    $q->where('name', 'like', "%{$this->search}%");
                });
        }

        return $query
            ->orderBy($this->sort, $this->direction)
            ->paginate($this->cant);
    }

    #[Computed]
    public function brands()
    {
        return \App\Models\Brand::orderBy('name')->get();
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
        $modello = Modello::findOrFail($id);
        $this->modello_id = $modello->id;
        $this->name = $modello->name;
        $this->brand_id = $modello->brand_id;
        $this->open_edit = true;
    }

    public function cancelar()
    {
        $this->reset(['open_edit', 'modello_id', 'name', 'brand_id']);
        $this->resetValidation();
    }

    public function update()
    {
        $this->validate([
            'name' => 'required|string|min:2|max:150',
            'brand_id' => 'nullable|exists:brands,id',
        ]);

        $modello = Modello::find($this->modello_id);
        $modello->update([
            'name' => $this->name,
            'brand_id' => $this->brand_id,
        ]);

        $this->reset(['open_edit', 'modello_id', 'name', 'brand_id']);
        $this->dispatch('swal:success', title: 'Actualizado', text: 'El modelo fue modificado correctamente.');
    }

    public function confirmarEliminado($id)
    {
        $this->dispatch('confirmareliminadooo', message: '¿Estás seguro de eliminar este registro?', id: $id);
        $this->modello_id = $id;
    }

    #[On('eliminar')]
    public function eliminar()
    {
        $modello = Modello::find($this->modello_id);
        if ($modello) {
            $modello->delete();
            $this->dispatch('swal:success', title: 'Eliminado', text: 'El modelo fue eliminado correctamente.');
        }
    }

    public function render()
    {
        return view('livewire.admin.modello-list', [
            'modellos' => $this->modellos,
            'brands' => $this->brands,
        ])->layout('layouts.app');
    }
}
