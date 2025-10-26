<?php

namespace App\Livewire\Admin;

use App\Models\Version;
use App\Models\Modello;
use App\Models\Brand;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Computed;
use Livewire\Attributes\On;
use Livewire\Attributes\Lazy;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class VersionList extends Component
{
    use WithPagination;
    use AuthorizesRequests; //para permisos

    public $search = '';
    public $sort = 'id';
    public $direction = 'desc';
    public $cant = 10;

    public $open_edit = false;

    // Campos de edición
    public $version_id;
    public $brand_id = '';
    public $modello_id = '';
    public $name = '';
    public $modellos = [];

    #[On('version-creada')]
    public function actualizarLista()
    {
        $this->resetPage();
    }


    #[Computed]
    #[Lazy]
    public function versions()
    {
        $query = Version::with(['modello.brand']);

        if ($this->search) {
            $query->where(function ($q) {
                $q->where('name', 'like', "%{$this->search}%")
                    ->orWhereHas('modello', function ($m) {
                        $m->where('name', 'like', "%{$this->search}%")
                            ->orWhereHas('brand', function ($b) {
                                $b->where('name', 'like', "%{$this->search}%");
                            });
                    });
            });
        }

        // Orden dinámico seguro
        switch ($this->sort) {
            case 'brand_name':
                $query->whereHas('modello.brand')
                    ->orderBy(
                        Brand::select('name')
                            ->whereColumn('brands.id', 'modellos.brand_id')
                            ->limit(1),
                        $this->direction
                    );
                break;

            case 'modello_name':
                $query->whereHas('modello')
                    ->orderBy(
                        Modello::select('name')
                            ->whereColumn('modellos.id', 'versions.modello_id')
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
    public function brands()
    {
        return Brand::orderBy('name')->get();
    }

    public function updatedBrandId($brand_id)
    {
        $this->modellos = Modello::where('brand_id', $brand_id)->orderBy('name')->get();
        $this->modello_id = '';
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
        $version = Version::with('modello.brand')->findOrFail($id);

        $this->version_id = $version->id;
        $this->name = $version->name;
        $this->brand_id = $version->modello->brand_id ?? '';
        $this->modello_id = $version->modello_id;

        $this->modellos = Modello::where('brand_id', $this->brand_id)->orderBy('name')->get();

        $this->open_edit = true;
    }

    public function cancelar()
    {
        $this->reset(['open_edit', 'version_id', 'brand_id', 'modello_id', 'name', 'modellos']);
        $this->resetValidation();
    }

    public function update()
    {
        $this->validate([
            'brand_id' => 'required|exists:brands,id',
            'modello_id' => 'required|exists:modellos,id',
            'name' => 'required|string|min:2|max:150',
        ]);

        $version = Version::find($this->version_id);

        if ($version) {
            $version->update([
                'name' => $this->name,
                'modello_id' => $this->modello_id,
            ]);

            $this->reset(['open_edit', 'version_id', 'brand_id', 'modello_id', 'name', 'modellos']);
            $this->dispatch('swal:success', title: 'Actualizado', text: 'La versión fue modificada correctamente.');
        }
    }

    public function confirmarEliminado($id)
    {
        $this->dispatch('confirmareliminadooo', message: '¿Estás seguro de eliminar este registro?', id: $id);
        $this->version_id = $id;
    }

    #[On('eliminar')]
    public function eliminar()
    {
        $version = Version::find($this->version_id);
        if ($version) {
            $version->delete();
            $this->dispatch('swal:success', title: 'Eliminado', text: 'La versión fue eliminada correctamente.');
        }
    }

    public function render()
    {
        $this->authorize('viewAny', Version::class);
        return view('livewire.admin.version-list', [
            'versions' => $this->versions,
            'brands' => $this->brands,
        ])->layout('layouts.app');
    }
}
