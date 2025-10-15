<?php

namespace App\Livewire\Admin;

use App\Models\Color;
use Livewire\Component;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class ColorCreate extends Component
{

    use AuthorizesRequests;

    public $open = false;
    public $name;

    protected $rules = [
        'name' => 'required|unique:colors',
    ];


    public function render()
    {
        return view('livewire.admin.color-create');
    }

    public function nuevo()
    {
        $this->open = true;
        $this->reset(['name']);
    }

    public function save()
    {
        //$this->authorize('create', new Category);
        $this->validate();

     
        Color::create([
            'name' => $this->name,      
        ]);

        $this->reset(['open', 'name']);

      
        // ✅ Emite evento global para que el otro componente lo escuche
        $this->dispatch('color-creado');

        /*tenemos que mandar asi de la forma de array no funca*/
        $this->dispatch('swal:success', title: '¡Guardado!', text: 'El color se creó correctamente.');

    }
    
}
