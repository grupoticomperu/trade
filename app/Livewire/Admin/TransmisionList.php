<?php

namespace App\Livewire\Admin;

use App\Models\Transmision;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Computed;
use Livewire\Attributes\On;
use Livewire\Attributes\Lazy;

class TransmisionList extends Component
{
    use WithPagination;

    public $search = '';
    public $sort = 'id';
    public $direction = 'desc';
    public $cant = 10;

    public $open_edit = false;
    public $transmision_id;
    public $name;

    #[On('transmision-creado')]
    public function actualizarLista()
    {
        $this->resetPage();
    }

    #[Computed]
    #[Lazy]
    public function transmisions()
    {
        $query = Transmision::query();

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

    public function edit($id)
    {
        $trans = Transmision::findOrFail($id);
        $this->transmision_id = $trans->id;
        $this->name = $trans->name;
        $this->open_edit = true;
    }

    public function cancelar()
    {
        $this->reset(['open_edit', 'transmision_id', 'name']);
        $this->resetValidation();
    }

    public function update()
    {
        $this->validate([
            'name' => 'required|string|min:2|max:150|unique:transmisions,name,' . $this->transmision_id,
        ]);

        $trans = Transmision::find($this->transmision_id);
        $trans->update(['name' => $this->name]);

        $this->reset(['open_edit', 'transmision_id', 'name']);
        $this->dispatch('swal:success', title: 'Actualizado', text: 'La transmisión fue modificada correctamente.');
    }

    public function confirmarEliminado($id)
    {
        $this->dispatch('confirmareliminadooo', message: '¿Estás seguro de eliminar este registro?', id: $id);
        $this->transmision_id = $id;
    }

    #[On('eliminar')]
    public function eliminar()
    {
        $trans = Transmision::find($this->transmision_id);
        if ($trans) {
            $trans->delete();
            $this->dispatch('swal:success', title: 'Eliminado', text: 'La transmisión fue eliminada correctamente.');
        }
    }

    public function render()
    {
        return view('livewire.admin.transmision-list', [
            'transmisions' => $this->transmisions,
        ])->layout('layouts.app');
    }
}
