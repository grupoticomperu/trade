<?php

namespace App\Livewire\Admin;

use App\Models\Brand;
use App\Models\Modello;
use App\Models\Version;
use Livewire\Component;

class VersionCreate extends Component
{
    public $open = false;

    public $brand_id = '';
    public $modello_id = '';
    public $name = '';

    public $modellos = [];

    protected $rules = [
        'brand_id' => 'required|exists:brands,id',
        'modello_id' => 'required|exists:modellos,id',
        'name' => 'required|string|min:2|max:150',
    ];

    // 🔹 Al cambiar la marca, actualiza los modelos
    public function updatedBrandId($brand_id)
    {
        $this->modellos = Modello::where('brand_id', $brand_id)
            ->orderBy('name')
            ->get();

        // Reinicia el modelo seleccionado
        $this->modello_id = '';
    }

    public function nuevo()
    {
        $this->resetValidation();
        $this->reset(['brand_id', 'modello_id', 'name', 'modellos']);
        $this->open = true;
    }

    public function save()
    {
        $this->validate();

        Version::create([
            'name' => $this->name,
            'modello_id' => $this->modello_id,
        ]);

        $this->reset(['open', 'brand_id', 'modello_id', 'name', 'modellos']);
        $this->dispatch('version-creada');
        $this->dispatch('swal:success', title: 'Guardado', text: 'La versión se creó correctamente.');
    }

    public function render()
    {
        return view('livewire.admin.version-create', [
            'brands' => Brand::orderBy('name')->get(),
        ]);
    }
}
