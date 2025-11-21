<?php

namespace App\Livewire\Admin\Distritos;

use Livewire\Component;

use App\Models\Distrito;

use Illuminate\Support\Str;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Create extends Component
{

    use AuthorizesRequests;
    public $open = false;
    public $name;


    public function render()
    {
        return view('livewire.admin.distritos.create');
    }


    public function nuevo()
    {
        $this->open = true;
    }


    protected $rules = [
        'name' => 'required|unique:distritos',
    ];


    public function save()
    {
        //$this->authorize('create', new Tipomarketing);
        $this->validate();


        Distrito::create([
            'name' => $this->name,
        ]);

        $this->reset(['open', 'name']);

        //$this->emitTo('admin.category-list', 'render');

        // ✅ Emite evento global para que el otro componente lo escuche
        $this->dispatch('distrito-creada');


        /*  $this->dispatch('swal:success', [
            'title' => '¡Guardado!',
            'text' => 'La categoría se creó correctamente.',
        ]);  */

        /*tenemos que mandar asi de la forma de array no funca*/

        $this->dispatch('swal:success', title: '¡Guardado!', text: 'El Distrito se creó correctamente.');



        //$this->emit('alert', 'La categoria se creo correctamente');
    }
}
