<?php

namespace App\Livewire\Admin\Tipomarketings;

use App\Models\Tipomarketing;
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


    // Filtros
    public string $filterHasOrder = 'all'; // all | with | without
    public string $filterCreated = 'all'; // all | today | last7 | thisMonth


    protected $queryString = [
        'search' => ['except' => ''],
        'sortField' => ['except' => 'id'],
        'sortDirection' => ['except' => 'desc'],
        'perPage' => ['except' => 10],
        'filterHasOrder' => ['except' => 'all'],
        'filterCreated' => ['except' => 'all'],
        'page' => ['except' => 1],
    ];

    public function mount(): void
    {
        //$this->authorize('viewAny', Tipomarketing::class);
    }


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
        $model = Tipomarketing::findOrFail($id);
        $this->authorize('delete', $model);
        $model->delete();


        $this->dispatch('swal', type: 'success', title: 'Eliminado', text: 'El registro se eliminó correctamente.');
        $this->resetPage();
    }


    public function render()
    {
        $query = Tipomarketing::query()
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


        $tipomarketings = $query->paginate($this->perPage);


        return view('livewire.admin.tipomarketings.index', [
            'tipomarketings' => $tipomarketings,
        ]);
    }
}
