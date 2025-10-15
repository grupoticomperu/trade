<?php

namespace App\Livewire\Admin;

use App\Models\Traccion;
use Livewire\Component;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class TraccionCreate extends Component
{
    use AuthorizesRequests;

    public $open = false;
    public $name;

    protected $rules = [
        'name' => 'required|string|min:2|max:150|unique:traccions,name',
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

        Traccion::create(['name' => $this->name]);

        $this->reset(['open', 'name']);
        $this->dispatch('traccion-creado');
        $this->dispatch('swal:success', title: 'Guardado', text: 'La tracción se creó correctamente.');
    }

    public function render()
    {
        return view('livewire.admin.traccion-create');
    }
}
