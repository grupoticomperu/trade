<?php

namespace App\Livewire\Admin;

use App\Models\Modello;
use App\Models\Brand;
use Livewire\Component;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class ModelloCreate extends Component
{
    use AuthorizesRequests;

    public $open = false;
    public $name;
    public $brand_id;

    protected $rules = [
        'name' => 'required|string|min:2|max:150',
        'brand_id' => 'nullable|exists:brands,id',
    ];

    public function nuevo()
    {
        $this->resetValidation();
        $this->reset(['name', 'brand_id']);
        $this->open = true;
    }

    public function save()
    {
        $this->validate();

        Modello::create([
            'name' => $this->name,
            'brand_id' => $this->brand_id,
        ]);

        $this->reset(['open', 'name', 'brand_id']);
        $this->dispatch('modello-creado');
        $this->dispatch('swal:success', title: 'Guardado', text: 'El modelo se creó correctamente.');
    }

    public function render()
    {
        return view('livewire.admin.modello-create', [
            'brands' => Brand::orderBy('name')->get(),
        ]);
    }
}
