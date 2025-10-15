<?php

namespace App\Livewire\Admin;

use App\Models\Etapa;
use Livewire\Component;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class EtapaCreate extends Component
{
    use AuthorizesRequests;

    public $open = false;
    public $name;
    public $order;

    protected $rules = [
        'name' => 'required|string|min:2|max:150|unique:etapas,name',
        'order' => 'nullable|integer|min:1|max:999',
    ];

    public function nuevo()
    {
        $this->resetValidation();
        $this->reset(['name', 'order']);
        $this->open = true;
    }

    public function save()
    {
        $this->validate();

        Etapa::create([
            'name' => $this->name,
            'order' => $this->order,
        ]);

        $this->reset(['open', 'name', 'order']);
        $this->dispatch('etapa-creado');
        $this->dispatch('swal:success', title: 'Guardado', text: 'La etapa se creó correctamente.');
    }

    public function render()
    {
        return view('livewire.admin.etapa-create');
    }
}
