<?php

namespace App\Livewire\Admin;
use Livewire\WithPagination;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Attributes\On;
use App\Models\Producto;
use Livewire\Component;


//php artisan make:livewire Admin/ProductoList
class ProductoList extends Component
{

    use AuthorizesRequests;
    use WithPagination;

    public $producto;
    public $productoId;
    public $search;
    public $sort = 'id';
    public $direction = 'desc';
    public $cant = 10;
    public $stateFilter = 'all';
    public $readyToLoad = false; // preloader
    public $created_at;

    // selección múltiple
    public $selected = [];
    public $selectAll = false;

    protected $queryString = [
        'cant' => ['except' => '10'],
        'sort' => ['except' => 'id'],
        'direction' => ['except' => 'desc'],
        'search' => ['except' => ''],
    ];

    private function resetSelected()
    {
        $this->selectAll = false;
        $this->selected = [];
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function loadProductos()
    {
        $this->readyToLoad = true;
    }

    public function updatedStateFilter()
    {
        $this->resetPage();
    }

    public function render()
    {
        $this->authorize('viewAny', Producto::class);

        $user = auth()->user();
        $query = Producto::query()
            ->where('nombre', 'like', '%' . $this->search . '%')
           ->when($this->stateFilter === 'disp', fn($q) => $q->where('state', 0))
            ->when($this->stateFilter === 'res', fn($q) => $q->where('state', 1))
            ->when($this->stateFilter === 'vend', fn($q) => $q->where('state', 2))
            ->when($this->stateFilter === 'comp', fn($q) => $q->where('state', 3)); 

        if (!$user->hasRole('Admin')) {
            $query->where('user_id', $user->id);
        }

        $productos = $query->orderBy($this->sort, $this->direction)->paginate($this->cant);
        //$productos = $query->orderBy('id', 'desc')->paginate($this->cant);

        //dd($productos);

        return view('livewire.admin.producto-list', compact('productos'));
    }

    public function cambiarEstado($productoId, $nuevoEstado)
    {
        $producto = Producto::findOrFail($productoId);
        $producto->update(['state' => $nuevoEstado]);
    }

    public function confirmarEliminado($id)
    {
        $this->productoId = $id;
        $this->dispatch('confirmareliminado');
    }

    #[On('eliminar')]
    public function delete()
    {
        if ($this->productoId) {
            $producto = Producto::find($this->productoId);
            $this->authorize('delete', $producto);

            if ($producto) {
                $producto->delete();

                $this->dispatch('borrado', [
                    'message' => 'Producto eliminado con éxito.',
                ]);
            } else {
                $this->dispatch('borrado', [
                    'message' => 'Producto no encontrado.',
                    'type' => 'error',
                ]);
            }
            $this->reset('productoId');
        }
    }

    public function order($sort)
    {
        if ($this->sort == $sort) {
            $this->direction = $this->direction == 'desc' ? 'asc' : 'desc';
        } else {
            $this->sort = $sort;
            $this->direction = 'asc';
        }
    }


    
}
