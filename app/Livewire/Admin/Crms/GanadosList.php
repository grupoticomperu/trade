<?php

namespace App\Livewire\Admin\Crms;

use Livewire\Component;

use App\Models\Crm;
use Livewire\WithPagination;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;


class GanadosList extends Component
{

    use AuthorizesRequests, WithPagination;

    public $search = '';
    public $cant = 10;
    public $readyToLoad = false;

    protected $queryString = [
        'cant' => ['except' => '10'],
        'search' => ['except' => ''],
    ];

    public function loadCrms()
    {
        $this->readyToLoad = true;
    }


    public function abrirModalCompra(int $crmId): void
    {
        // El envío es 100% server-side; Livewire gestiona el payload como nombrado.
        $this->dispatch('crear-compra', crmId: $crmId);
    }



    public function render()
    {
        $this->authorize('viewAny', Crm::class);
        $user = auth()->user();

        if (!$this->readyToLoad) {
            return view('livewire.admin.crms.ganados-list', ['crms' => collect()])->layout('layouts.app');
        }

        $base = Crm::with(['proveedor', 'producto', 'etapa', 'compra'])->ganados();

        if (!$user->hasRole('Admin')) {
            $base->where('user_id', $user->id);
        }

        if (filled($this->search)) {
            $s = "%{$this->search}%";
            $base->where(function ($q) use ($s) {
                $q->where('nombre', 'like', $s)
                    ->orWhereHas('proveedor', fn($qq) => $qq->where('nombre', 'like', $s))
                    ->orWhereHas('producto', fn($qq) => $qq->where('nombre', 'like', $s));
            });
        }

        $crms = $base->latest()->paginate($this->cant);

        return view('livewire.admin.crms.ganados-list', compact('crms'))->layout('layouts.app');
    }
}
