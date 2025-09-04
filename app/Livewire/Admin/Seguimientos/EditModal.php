<?php

namespace App\Livewire\Admin\Seguimientos;

use Livewire\Component;
use Livewire\Attributes\On;
use App\Models\Seguimiento;
use App\Models\Crm;

class EditModal extends Component
{


    public bool $open = false;

    public ?int $seguimientoId = null;
    public ?int $crmId = null;
    public ?string $nombre = null;
    public ?string $fecha = null;

    // (Opcional) CRM de contexto para validar pertenencia
    public ?int $contextCrmId = null;

    #[On('editar-seguimiento')]
    public function openModal(int $id): void
    {
        $seg = Seguimiento::findOrFail($id);

        // Si quieres forzar que el seg pertenezca al CRM de la página:
        if ($this->contextCrmId && $seg->crm_id !== $this->contextCrmId) {
            abort(403, 'El seguimiento no pertenece a esta oportunidad.');
        }

        $this->seguimientoId = $seg->id;
        $this->crmId         = $seg->crm_id;
        $this->nombre        = $seg->nombre;
        $this->fecha         = optional($seg->fecha)->format('Y-m-d');

        $this->open = true;
    }

    public function save()
    {
        $this->validate([
            'nombre' => ['nullable', 'string'],
            'crmId'  => ['nullable', 'exists:crms,id'],
            'fecha'  => ['nullable', 'date'],
        ]);

        $seg = Seguimiento::findOrFail($this->seguimientoId);

        if ($this->contextCrmId && $seg->crm_id !== $this->contextCrmId) {
            abort(403, 'El seguimiento no pertenece a esta oportunidad.');
        }

        $seg->update([
            'nombre' => $this->nombre,
            'crm_id' => $this->crmId,
            'fecha'  => $this->fecha ?: null,
        ]);

        // Redirige a la misma lista del CRM para ver cambios reflejados
        return redirect()
            ->route('admin.crms.seguimientos.index', $this->contextCrmId ?: $seg->crm_id)
            ->with('status', 'Seguimiento actualizado correctamente.');
    }

    public function close(): void
    {
        $this->reset(['open', 'seguimientoId', 'nombre', 'fecha', 'crmId']);
    }

    public function render()
    {
        // Lista corta de CRMs para el select (ajusta a tu realidad)
        $crms = Crm::orderBy('id', 'desc')->limit(50)->get(['id', 'nombre']);

        return view('livewire.admin.seguimientos.edit-modal', compact('crms'));
    }


    
}
