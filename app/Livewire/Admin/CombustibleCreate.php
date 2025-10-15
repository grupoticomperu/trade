<?php

namespace App\Livewire\Admin;

use App\Models\Combustible;
use Livewire\Component;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class CombustibleCreate extends Component
{
    use AuthorizesRequests;

    public $open = false;
    public $name;

    protected $rules = [
        'name' => 'required|string|min:2|max:50|unique:combustibles,name',
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

        Combustible::create(['name' => $this->name]);

        $this->reset(['open', 'name']);
        $this->dispatch('combustible-creado');
        $this->dispatch('swal:success', title: 'Guardado', text: 'El combustible se creó correctamente.');
    }

    public function render()
    {
        return view('livewire.admin.combustible-create');
    }
}
