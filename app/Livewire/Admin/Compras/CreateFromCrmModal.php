<?php

namespace App\Livewire\Admin\Compras;

use Livewire\Component;
use App\Models\Crm;
use App\Models\Compra;
use Livewire\Attributes\On;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Str;

class CreateFromCrmModal extends Component
{

    use AuthorizesRequests;

    public bool $open = false;

    public ?int $crmId = null;

    public ?float $precio = null;

    public ?string $numcomprobante = null;
    public ?string $fecha = null;         // <- ahora se llama igual que en la BD

    public ?string $observacion = null;

    public ?string $proveedorNombre = null;
    public ?string $vehiculoNombre = null;




    #[On('crear-compra')]
    public function openFor(int $crmId)
    {
        $crm = Crm::with(['proveedor', 'producto', 'etapa'])->findOrFail($crmId);

        if (!$crm->etapa || ! in_array(\Illuminate\Support\Str::lower($crm->etapa->name), ['ganado', 'finalizado'])) {
            abort(422, 'La oportunidad no está en etapa “ganado/finalizado”.');
        }

        $this->crmId           = $crm->id;
        $this->fecha           = now()->toDateString();  // <-- 'fecha' (no fecha_emision)
        $this->numcomprobante  = null;                   // o genera uno si quieres
        $this->precio          = (float) ($crm->precio ?? 0);
        $this->proveedorNombre = $crm->proveedor->nombre ?? '—';
        $this->vehiculoNombre  = $crm->producto->nombre ?? '—';
        $this->open = true;
    }




    public function save()
    {
        $this->validate([
            'crmId'          => ['required', 'exists:crms,id'],
            'numcomprobante' => ['nullable', 'string', 'max:255'],
            'fecha'          => ['required', 'date'],          // <- usa 'fecha'
            'precio'         => ['nullable', 'numeric', 'min:0'],
            'observacion'    => ['nullable', 'string'],
        ]);

        $crm = \App\Models\Crm::with(['proveedor', 'producto'])->findOrFail($this->crmId);
        $this->authorize('view', $crm);

        // Evita duplicados por CRM (si quieres permitir varios, quita esto)
        if (\App\Models\Compra::where('crm_id', $crm->id)->exists()) {
            return $this->addError('crmId', 'Ya existe un documento para esta oportunidad.');
        }

        $compra = \App\Models\Compra::create([
            'crm_id'        => $crm->id,
            'proveedor_id'  => optional($crm->proveedor)->id,
            'producto_id'   => optional($crm->producto)->id,
            'user_id'       => auth()->id(),          // <- quién genera
            'etapa_id'      => $crm->etapa_id,        // <- inicia con la misma etapa o ajusta a tu flujo
            'numcomprobante' => $this->numcomprobante, // <- nuevo
            'fecha'         => $this->fecha,          // <- nuevo
            'precio'        => $this->precio,
            'observacion'   => $this->observacion,
        ]);

        // Notifica a la lista (sin recargar) y cierra
        $this->dispatch('compra-creada', compraId: $compra->id, crmId: $crm->id);
        $this->reset();
        $this->open = false;

        // (Opcional) toast
        $this->dispatch('toast', type: 'success', message: "Documento #{$compra->id} generado.");
    }






    public function close()
    {
        $this->reset();
        $this->open = false;
    }

    public function render()
    {
        return view('livewire.admin.compras.create-from-crm-modal');
    }
}
