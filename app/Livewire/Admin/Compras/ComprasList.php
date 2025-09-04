<?php

namespace App\Livewire\Admin\Compras;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Compra;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Attributes\On;

class ComprasList extends Component
{


    use AuthorizesRequests, WithPagination;

    public $search = '';
    public $cant = 10;
    public $readyToLoad = false;

    protected $queryString = [
        'cant'   => ['except' => '10'],
        'search' => ['except' => ''],
    ];

    public function loadCompras()
    {
        $this->readyToLoad = true;
    }

    public function abrirModalDetalle(int $compraId): void
    {
        // Envío server→server para evitar issues de parámetros
        $this->dispatch('ver-compra', compraId: $compraId);
    }

    public function render()
    {
       // $this->authorize('viewAny', Compra::class);

        if (!$this->readyToLoad) {
            return view('livewire.admin.compras.compras-list', ['compras' => collect()])
                ->layout('layouts.app');
        }

        $q = Compra::with(['proveedor', 'producto', 'etapa', 'crm', 'user'])
            ->latest();

        if (filled($this->search)) {
            $s = "%{$this->search}%";
            $q->where(function ($qq) use ($s) {
                $qq->where('numcomprobante', 'like', $s)
                    ->orWhere('observacion', 'like', $s)
                    ->orWhereHas('proveedor', fn($q1) => $q1->where('nombre', 'like', $s))
                    ->orWhereHas('producto', fn($q2) => $q2->where('nombre', 'like', $s))
                    ->orWhereHas('crm',      fn($q3) => $q3->where('nombre', 'like', $s))
                    ->orWhereHas('user',     fn($q4) => $q4->where('name', 'like', $s));
            });
        }

        $compras = $q->paginate($this->cant);

        return view('livewire.admin.compras.compras-list', compact('compras'))
            ->layout('layouts.app');
    }


}
