<?php

namespace App\Livewire\Admin\Compras;

use Livewire\Component;
use Livewire\Attributes\On;
use App\Models\Compra;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class ShowModal extends Component
{

    use AuthorizesRequests;

    public bool $open = false;

    // Campos a mostrar
    public ?int $compraId = null;
    public ?string $numcomprobante = null;
    public ?string $fecha = null;
    public ?string $proveedorNombre = null;
    public ?string $vehiculoNombre = null;
    public ?string $usuarioNombre = null;
    public ?string $etapaNombre = null;
    public ?float $precio = null;
    public ?string $observacion = null;
    public ?int $crmId = null;
    public ?string $crmNombre = null;

    #[On('ver-compra')]
    public function openFor(int $compraId)
    {
        $cmp = Compra::with(['proveedor', 'producto', 'etapa', 'crm', 'user'])->findOrFail($compraId);
       // $this->authorize('view', $cmp);

        $this->compraId        = $cmp->id;
        $this->numcomprobante  = $cmp->numcomprobante;
        $this->fecha           = optional($cmp->fecha)->format('Y-m-d');
        $this->proveedorNombre = $cmp->proveedor->nombre ?? '—';
        $this->vehiculoNombre  = $cmp->producto->nombre ?? '—';
        $this->usuarioNombre   = $cmp->user->name ?? '—';
        $this->etapaNombre     = $cmp->etapa->name ?? '—';
        $this->precio          = $cmp->precio;
        $this->observacion     = $cmp->observacion;
        $this->crmId           = $cmp->crm_id;
        $this->crmNombre       = $cmp->crm->nombre ?? ('CRM #' . $cmp->crm_id);

        $this->open = true;
    }

    public function close(): void
    {
        $this->reset();
        $this->open = false;
    }

    public function render()
    {
        return view('livewire.admin.compras.show-modal');
    }

   
}
