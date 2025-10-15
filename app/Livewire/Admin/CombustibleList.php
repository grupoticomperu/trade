<?php

namespace App\Livewire\Admin;

use App\Models\Combustible;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Computed;
use Livewire\Attributes\On;
use Livewire\Attributes\Lazy;

class CombustibleList extends Component
{
    use WithPagination;

    public $search = '';
    public $sort = 'id';
    public $direction = 'desc';
    public $cant = 10;

    public $open_edit = false;
    public $combustible_id;
    public $name;

    #[On('combustible-creado')]
    public function actualizarLista()
    {
        $this->resetPage(); // refresca al crear uno nuevo
    }

    #[Computed]
    #[Lazy]
    public function combustibles()
    {
        $query = Combustible::query();

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

    // Editar
    public function edit($id)
    {
        $comb = Combustible::findOrFail($id);
        $this->combustible_id = $comb->id;
        $this->name = $comb->name;
        $this->open_edit = true;
    }

    public function cancelar()
    {
        $this->reset(['open_edit', 'combustible_id', 'name']);
        $this->resetValidation();
    }

    // Actualizar
    public function update()
    {
        $this->validate([
            'name' => 'required|string|min:2|max:50|unique:combustibles,name,' . $this->combustible_id,
        ]);

        $comb = Combustible::find($this->combustible_id);
        $comb->update(['name' => $this->name]);

        $this->reset(['open_edit', 'combustible_id', 'name']);
        $this->dispatch('swal:success', title: 'Actualizado', text: 'El combustible fue modificado correctamente.');
    }

    // Eliminar
    public function confirmarEliminado($id)
    {
        $this->dispatch('confirmareliminadooo', message: '¿Estás seguro de eliminar este registro?', id: $id);
        $this->combustible_id = $id;
    }

    #[On('eliminar')]
    public function eliminar()
    {
        $comb = Combustible::find($this->combustible_id);
        if ($comb) {
            $comb->delete();
            $this->dispatch('swal:success', title: 'Eliminado', text: 'El combustible fue eliminado correctamente.');
        }
    }

    public function render()
    {
        return view('livewire.admin.combustible-list', [
            'combustibles' => $this->combustibles,
        ])->layout('layouts.app');
    }
}
