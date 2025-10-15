<?php

namespace App\Livewire\Admin;

use App\Models\Distrito;
use Livewire\Component;

class DistritoCreate extends Component
{
    public $open_create = false;
    public $name;

    public function save()
    {
        $this->validate([
            'name' => 'required|string|min:2|max:150|unique:distritos,name',
        ]);

        Distrito::create(['name' => $this->name]);

        $this->reset(['open_create', 'name']);
        $this->dispatch('swal:success', title: 'Creado', text: 'El distrito fue registrado correctamente.');
        $this->dispatch('distrito-creado');
    }

    public function render()
    {
        return view('livewire.admin.distrito-create');
    }
}
