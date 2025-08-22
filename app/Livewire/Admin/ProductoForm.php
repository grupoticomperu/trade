<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\Brand;
use App\Models\Modello;
use App\Models\Version;
use App\Models\Producto;
//php artisan make:livewire Admin/producto-form
class ProductoForm extends Component
{
    public $producto;

    // dropdowns
    public $brands = [];
    public $modellos = [];
    public $versions = [];

    // seleccionados
    public $brandId;
    public $modelloId;
    public $versionId;


    public function mount(Producto $producto)
    {
        $this->producto = $producto;

        // Cargar todas las marcas
        $this->brands = Brand::orderBy('name')->get();

        // Setear valores iniciales
        $this->brandId = $producto->brand_id;
        $this->modelloId = $producto->modello_id;
        $this->versionId = $producto->version_id;

        // Si ya tiene valores, poblar combos
        if ($this->brandId) {
            $this->modellos = Modello::where('brand_id', $this->brandId)->get();
        }

        if ($this->modelloId) {
            $this->versions = Version::where('modello_id', $this->modelloId)->get();
        }
    }


    public function updatedBrandId($value)
    {

        //dd("Cambió brandId", $value);

        $this->modellos = Modello::where('brand_id', $value)->get();
        $this->modelloId = null;
        $this->versions = [];
        $this->versionId = null;
    }

    public function updatedModelloId($value)
    {
        $this->versions = Version::where('modello_id', $value)->get();
        $this->versionId = null;
    }


    public function render()
    {
        return view('livewire.admin.producto-form');
    }
}
