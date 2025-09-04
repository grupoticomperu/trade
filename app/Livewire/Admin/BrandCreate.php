<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Models\Brand;

class BrandCreate extends Component
{
    use AuthorizesRequests;
    use WithFileUploads;
    public $open = false;
    //public $identificador;
    public $name, $state, $order, $image;

    public function nuevo()
    {
        //$this->identificador = rand();
        $this->open = true;
        $this->reset(['image']);
    }

    protected $rules = [
        'name' => 'required|unique:brands',
        'state' => 'nullable',
        'order' => 'nullable',
        //'image' => 'required|image|max:2048',
    ];



    public function render()
    {
        return view('livewire.admin.brand-create');
    }


    public function save()
    {
        $this->authorize('create', new Brand);
        $this->validate();

        // $image = $this->image->store('categories', 'public');
        //$urlimage = Storage::url($image);
        //dd($this->state);

        $statee = ($this->state) ? 1 : 0;


        brand::create([
            'name' => $this->name,

            'state' => $statee,

            'order' => $this->order,
            //'image' => $urlimage,

        ]);

        $this->reset(['open', 'name', 'image', 'state', 'order']);

        //$this->emitTo('admin.category-list', 'render');

        // Emite evento global para que el otro componente lo escuche
        $this->dispatch('marca-creada');

        /* $this->dispatch('swal:success', [
            'title' => '¡Guardado!',
            'text' => 'La narca se creó correctamente.',
        ]); */

        // Dentro del componente Livewire
        /* $this->dispatch(
            'swal:success',
            title: 'Guardado',
            text: 'La marca se creó correctamente.',
            icon: 'success'
        ); */

        $this->dispatch(
            'swal:success',
            title: 'Guardado',
            text: 'La marca se creó correctamente.',
            icon: 'success'
        );

        //$this->emit('alert', 'La categoria se creo correctamente');
    }



    public function cancelar()
    {
        $this->open = false;
        $this->reset(['open', 'name', 'image', 'state', 'order']);
    }
}
