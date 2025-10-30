<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\Color;
use App\Models\Producto;

class ProductoColorSelector extends Component
{

    public $producto;
    public $color_id;
    public $nuevo_color;
    public $colors;

    protected $rules = [
        'color_id' => 'nullable|exists:colors,id',
        'nuevo_color' => 'nullable|string|max:100',
    ];

    protected $messages = [
        'color_id.exists' => 'El color seleccionado no es válido.',
        'nuevo_color.string' => 'El nuevo color debe ser texto.',
        'nuevo_color.max' => 'El nombre del color no debe superar los 100 caracteres.',
    ];

    public function mount(Producto $producto)
    {
        $this->producto = $producto;
        $this->color_id = $producto->color_id;
        $this->colors = Color::orderBy('name')->get();
    }

    public function save()
    {
        $this->validate();

        // Si el usuario ingresó un nuevo color, lo creamos
        if ($this->nuevo_color) {
            $colorName = ucfirst(strtolower(trim($this->nuevo_color)));
            $color = Color::firstOrCreate(['name' => $colorName]);
            $this->color_id = $color->id;
            $this->nuevo_color = null; // limpiamos el campo
            $this->colors = Color::orderBy('name')->get(); // recargamos lista
        }

        // Actualizamos el producto con el nuevo color
        $this->producto->update(['color_id' => $this->color_id]);

        $this->dispatch('color-actualizado');

        session()->flash('swal', [
            'icon' => 'success',
            'title' => 'Color actualizado',
            'text' => 'El color se ha guardado correctamente.',
        ]);
    }



    public function render()
    {
        return view('livewire.admin.producto-color-selector');
    }
}
