<?php

namespace App\Livewire\Admin;

use App\Models\Year;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Computed;
use Livewire\Attributes\On;
use Livewire\Attributes\Lazy;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class YearList extends Component
{

    use WithPagination; //para paginacion
    use AuthorizesRequests; //para permisos

    
       

    public $search = '';
    public $sort = 'id';
    public $direction = 'desc';
    public $cant = 10;
    public $open_edit = false;
    //public $year;
    public $year_id;
    public $name;

    #[On('year-creado')]
    public function actualizarLista()
    {
        $this->resetPage(); // Refresca al crear un nuevo año
    }

    #[Computed]
    #[Lazy]
    public function years()
    {
        $query = Year::query();

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

    // 🔹 Cargar datos en el modal
    public function edit($id)
    {
        $year = Year::findOrFail($id);
        $this->year_id = $year->id;
        $this->name = $year->name;
        $this->open_edit = true;
    }

    public function cancelar()
    {
        $this->reset(['open_edit', 'year_id', 'name']);
        $this->resetValidation();
    }

    // 🔹 Guardar cambios
    public function update()
    {
        $this->validate([
            'name' => 'required|string|min:2|max:10|unique:years,name,' . $this->year_id,
        ]);

        $year = Year::find($this->year_id);
        $year->update(['name' => $this->name]);

        $this->reset(['open_edit', 'year_id', 'name']);

        $this->dispatch('swal:success', title: 'Actualizado', text: 'El año fue modificado correctamente.');
    }

    // 🔹 Eliminar con confirmación
    public function confirmarEliminado($id)
    {
        $this->dispatch('confirmareliminadooo', message: '¿Estás seguro de eliminar este registro?', id: $id);
        $this->year_id = $id;
    }

    #[On('eliminar')]
    public function eliminar()
    {
        $year = Year::find($this->year_id);
        if ($year) {
            $year->delete();
            $this->dispatch('swal:success', title: 'Eliminado', text: 'El año fue eliminado correctamente.');
        }
    }

    public function render()
    {
        $this->authorize('viewAny', Year::class);

        return view('livewire.admin.year-list', [
            'years' => $this->years,
        ])->layout('layouts.app');
    }
}
