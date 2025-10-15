<?php

namespace App\Livewire\Admin;

use App\Models\Year;
use Livewire\Component;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class YearCreate extends Component
{
    use AuthorizesRequests;

    public $open = false;
    public $name;

    protected $rules = [
        'name' => 'required|string|min:2|max:10|unique:years,name',
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

        Year::create([
            'name' => $this->name,
        ]);

        $this->reset(['open', 'name']);
        $this->dispatch('year-creado');

        $this->dispatch('swal:success', title: '¡Guardado!', text: 'El año se creó correctamente.');
    }

    public function render()
    {
        return view('livewire.admin.year-create');
    }
}