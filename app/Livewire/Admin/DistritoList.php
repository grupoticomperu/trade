<?php

namespace App\Livewire\Admin;

use App\Models\Distrito;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Computed;
use Livewire\Attributes\On;
use Livewire\Attributes\Lazy;

class DistritoList extends Component
{
    use WithPagination;

    public $search = '';
    public $sort = 'id';
    public $direction = 'desc';
    public $cant = 10;

    public $open_edit = false;
    public $distrito;
    public $name;

    #[On('distrito-creado')]
    public function actualizarLista()
    {
        $this->resetPage();
    }

    #[Computed]
    #[Lazy]
    public function distritos()
    {
        $query = Distrito::query();

        if ($this->search) {
            $query->where('name', 'like', "%{$this->search}%");
        }

        return $query->orderBy($this->sort, $this->direction)
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
        $this->distrito = Distrito::findOrFail($id);
        $this->name = $this->distrito->name;
        $this->open_edit = true;
    }

    public function cancelar()
    {
        $this->reset(['open_edit', 'name', 'distrito']);
        $this->resetValidation();
    }

    public function update()
    {
        $this->validate([
            'name' => 'required|string|min:2|max:150|unique:distritos,name,' . $this->distrito->id,
        ]);

        $this->distrito->update(['name' => $this->name]);
        $this->reset(['open_edit', 'name']);
        $this->dispatch('swal:success', title: 'Actualizado', text: 'El distrito fue modificado correctamente.');
    }

    public function confirmarEliminado($id)
    {
        $this->dispatch('confirmareliminadooo', message: '¿Deseas eliminar este distrito?', id: $id);
        $this->distrito = Distrito::find($id);
    }

    #[On('eliminar')]
    public function eliminar()
    {
        if ($this->distrito) {
            $this->distrito->delete();
            $this->dispatch('swal:success', title: 'Eliminado', text: 'El distrito fue eliminado correctamente.');
        }
    }

    public function render()
    {
        return view('livewire.admin.distrito-list', [
            'distritos' => $this->distritos,
        ])->layout('layouts.app');
    }
}
