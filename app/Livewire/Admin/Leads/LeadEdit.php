<?php

namespace App\Livewire\Admin\Leads;

use Livewire\Component;
use App\Models\Lead;
use App\Models\Brand;
use App\Models\Modello;
use App\Models\User;
use App\Models\Version;
use App\Models\Year;
use Carbon\Carbon;

class LeadEdit extends Component
{
    public $lead;

    // Campos del Lead
    public $fechaderivacion, $fecha, $nombres, $telefono, $correoelectronico;
    public $kilometraje, $placa, $state, $perfilcoincide, $esoportunidad, $observacion;

    // ✅ Relaciones con selects (usar camelCase)
    public $brandId, $modelloId, $versionId, $yearId, $userId;

    // Listas para selects
    public $brands = [];
    public $modellos = [];
    public $versions = [];
    public $years = [];

    public function mount(Lead $lead)
    {
        $this->lead = $lead;

        // Manejo robusto de fechas para input type="date"
        $this->fechaderivacion = $this->formatDateForInput($lead->fechaderivacion);
        $this->fecha = $this->formatDateForInput($lead->fecha);

        $this->fill($lead->only([
            'nombres','telefono','correoelectronico',
            'kilometraje','placa','state','perfilcoincide','esoportunidad','observacion'
        ]));

        // Cargar listas
        $this->brands = Brand::where('state', 1)->orderBy('name')->get();
        $this->years = Year::orderBy('name', 'desc')->get();

        // Preselección desde texto libre del lead
        $this->brandId = Brand::where('name', 'like', "%{$lead->marca}%")->value('id');

        if ($this->brandId) {
            $this->modellos = Modello::where('brand_id', $this->brandId)->orderBy('name')->get();
            $this->modelloId = Modello::where('brand_id', $this->brandId)
                ->where('name', 'like', "%{$lead->modelo}%")
                ->value('id');
        }

        if ($this->modelloId) {
            $this->versions = Version::where('modello_id', $this->modelloId)->orderBy('name')->get();
        }

        $this->yearId = Year::where('name', 'like', "%{$lead->anio}%")->value('id');
    }

    private function formatDateForInput($date)
    {
        if (!$date) return null;

        try {
            return Carbon::parse($date)->format('Y-m-d'); // Y-m-d
        } catch (\Exception $e) {
            try {
                return Carbon::createFromFormat('d/m/Y', $date)->format('Y-m-d'); // d/m/Y -> Y-m-d
            } catch (\Exception $e2) {
                return null;
            }
        }
    }
    // ✅ Hooks Livewire deben coincidir con propiedades camelCase
    public function updatedBrandId($value)
    {
        $this->modellos = Modello::where('brand_id', $value)->orderBy('name')->get();
        $this->modelloId = null;
        $this->versions = [];
        $this->versionId = null;
    }

    public function updatedModelloId($value)
    {
        $this->versions = Version::where('modello_id', $value)->orderBy('name')->get();
        $this->versionId = null;
    }

    public function save()
    {
        $fecha = $this->fecha ? Carbon::parse($this->fecha)->format('Y-m-d') : null;
        $fechaderivacion = $this->fechaderivacion ? Carbon::parse($this->fechaderivacion)->format('Y-m-d') : null;

        $this->lead->update([
            'fechaderivacion' => $fechaderivacion,
            'fecha' => $fecha,
            'marca' => optional(Brand::find($this->brandId))->name ?? $this->lead->marca,
            'modelo' => optional(Modello::find($this->modelloId))->name ?? $this->lead->modelo,
            'version' => optional(Version::find($this->versionId))->name ?? $this->lead->version,
            'anio' => optional(Year::find($this->yearId))->name ?? $this->lead->anio,
            'nombres' => $this->nombres,
            'telefono' => $this->telefono,
            'correoelectronico' => $this->correoelectronico,
            'kilometraje' => $this->kilometraje,
            'placa' => $this->placa,
            'state' => $this->state,
            'perfilcoincide' => $this->perfilcoincide,
            'esoportunidad' => $this->esoportunidad,
            'user_id' =>$this->userId,
            'observacion' => $this->observacion,
        ]);

        session()->flash('message', 'Lead actualizado correctamente.');
    }

    public function render()
    {
        $users = User::where('state', 1)->orderBy('name')->get();
        return view('livewire.admin.leads.lead-edit', compact('users'))->layout('layouts.app');
    }
}
