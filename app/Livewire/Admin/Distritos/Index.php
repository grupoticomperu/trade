<?php

namespace App\Livewire\Admin\Distritos;


use App\Models\Distrito;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Carbon;

use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;

#[Layout('layouts.app')]
#[Title('Tipomarketings')]
class Index extends Component
{

    use WithPagination, AuthorizesRequests;


    public string $search = '';
    public string $sortField = 'id';
    public string $sortDirection = 'desc';
    public int $perPage = 10; // 10, 25, 50

    public $open_edit = false;
    public $distritoid;


    // Filtros
    public string $filterHasOrder = 'all'; // all | with | without
    public string $filterCreated = 'all'; // all | today | last7 | thisMonth


    public $distrito = [
        'id' => null,
        'name' => '',
    ];


    protected $queryString = [
        'search' => ['except' => ''],
        'sortField' => ['except' => 'id'],
        'sortDirection' => ['except' => 'desc'],
        'perPage' => ['except' => 10],
        'filterHasOrder' => ['except' => 'all'],
        'filterCreated' => ['except' => 'all'],
        'page' => ['except' => 1],
    ];


    public function updatingSearch(): void
    {
        $this->resetPage();
    }
    public function updatedPerPage(): void
    {
        $this->resetPage();
    }
    public function updatedFilterHasOrder(): void
    {
        $this->resetPage();
    }
    public function updatedFilterCreated(): void
    {
        $this->resetPage();
    }


    public function sortBy(string $field): void
    {
        if ($this->sortField === $field) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortField = $field;
            $this->sortDirection = 'asc';
        }
        $this->resetPage();
    }


    public function confirmDelete(int $id): void
    {
        $this->dispatch('swal-confirm-delete', id: $id, title: '¿Eliminar registro?', text: 'Esta acción no se puede deshacer.');
    }

    #[On('deleteConfirmed')]
    public function deleteConfirmed(int $id): void
    {
        $model = Distrito::findOrFail($id);
        $this->authorize('delete', $model);
        $model->delete();


        $this->dispatch('swal', type: 'success', title: 'Eliminado', text: 'El registro se eliminó correctamente.');
        $this->resetPage();
    }


    #[On('distrito-creada')] // Escucha el evento
    public function render()
    {
        $query = Distrito::query()
            ->when($this->search !== '', fn($q) => $q->where('name', 'like', "%{$this->search}%"))
            ->when($this->filterHasOrder === 'with', fn($q) => $q->whereNotNull('order'))
            ->when($this->filterHasOrder === 'without', fn($q) => $q->whereNull('order'))
            ->when($this->filterCreated !== 'all', function ($q) {
                $now = now();
                return match ($this->filterCreated) {
                    'today' => $q->whereDate('created_at', $now->toDateString()),
                    'last7' => $q->whereDate('created_at', '>=', $now->copy()->subDays(7)->toDateString()),
                    'thisMonth' => $q->whereYear('created_at', $now->year)->whereMonth('created_at', $now->month),
                    default => $q,
                };
            })
            ->orderBy($this->sortField, $this->sortDirection);


        $distritos = $query->paginate($this->perPage);


        return view('livewire.admin.distritos.index', [
            'distritos' => $distritos,
        ]);
    }


    public function cancelar()
    {
        $this->reset('open_edit', 'distrito');
        $this->resetValidation();
    }


    protected function rules()
    {
        return [
            'distrito.name'  => 'required|string|max:255|unique:distritos,name,' . ($this->distrito['id'] ?? 'NULL'),
        ];
    }


    public function edit($id)
    {
        $model = Distrito::findOrFail($id);

        $this->distrito = [
            'id' => $model->id,
            'name' => $model->name,
        ];

        $this->resetValidation();
        $this->open_edit = true;
    }


    public function update()
    {
        $this->validate();

        $model = Distrito::findOrFail($this->distrito['id']);
        $model->name = $this->distrito['name'];
        $model->save();

        $this->reset(['open_edit', 'distrito']);
        $this->resetValidation();

        /* $this->dispatch('Actualizado', [
            'message' => 'Tipomarketing actualizada con éxito.',
        ]); */

        $this->dispatch('swal:success', title: '¡Guardado!', text: 'El Distrito se Actualizo correctamente.');
    }


    public function confirmarEliminado($id)
    {
        $this->distritoid = $id;

        $this->dispatch('confirmareliminadooo');
    }

    #[On('eliminar')] // Escucha el evento "eliminar"
    public function delete()
    {
        //$this->authorize('delete', $user);
        if ($this->distritoid) {
            $distrito = Distrito::find($this->distritoid);

            if ($distrito) {
                $distrito->delete();

                // Notifica éxito
                $this->dispatch('borrado', [
                    'message' => 'Distrito eliminada con éxito.',
                ]);
            } else {
                // Notifica error si el usuario no existe
                $this->dispatch('borrado', [
                    'message' => 'Distrito no encontrado.',
                    'type' => 'error',
                ]);
            }

            $this->reset('distritoid');
        }
    }
}
