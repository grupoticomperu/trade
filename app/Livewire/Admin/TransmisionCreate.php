<?php

namespace App\Livewire\Admin;

use App\Models\Transmision;
use Livewire\Component;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class TransmisionCreate extends Component
{
    use AuthorizesRequests;

    public $open = false;
    public $name;

    protected $rules = [
        'name' => 'required|string|min:2|max:150|unique:transmisions,name',
    ];

    public function nuevo()
    {
        $this->resetValidation();
        $this->reset(['name']);
        $this->open = true;
    }

    public function save()
    {
        $this->validate();

        Transmision::create(['name' => $this->name]);

        $this->reset(['open', 'name']);
        $this->dispatch('transmision-creado');
        $this->dispatch('swal:success', title: 'Guardado', text: 'La transmisión se creó correctamente.');
    }

    public function render()
    {
        return view('livewire.admin.transmision-create');
    }
}
