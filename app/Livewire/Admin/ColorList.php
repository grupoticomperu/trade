<?php

namespace App\Livewire\Admin;

use App\Models\Color;
use Livewire\Component;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\WithPagination;
use Livewire\Attributes\On;

class ColorList extends Component
{
    use AuthorizesRequests;
    use WithPagination;
    public $search;
    public $sort = 'id';
    public $direction = 'desc';
    public $cant = '10';
    public $readyToLoad = false; //para controlar el preloader inicia en false 
    public $open_edit = false;
    public $color;
    public $colorid;

    protected $queryString = [
        'cant' => ['except' => '10'],
        'sort' => ['except' => 'id'],
        'direction' => ['except' => 'desc'],
        'search' => ['except' => ''],
    ];

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function loadColors()
    {
        $this->readyToLoad = true;
    }

    #[On('color-creado')] // Escucha el evento
    public function render()
    {
        
        if ($this->readyToLoad) {
            $colors = Color::where('name', 'like', '%' . $this->search . '%')->orderBy($this->sort, $this->direction)
                ->paginate($this->cant);
        } else {
            $colors = [];
        }


        return view('livewire.admin.color-list', compact('colors'))->layout('layouts.app');
    }


    public function order($sort)
    {
        if ($this->sort == $sort) {
            if ($this->direction == 'desc') {
                $this->direction = 'asc';
            } else {
                $this->direction = 'desc';
            }
        } else {
            $this->sort = $sort;
            $this->direction = 'asc';
        }
    }


    public function edit($id)
    {
        $model = Color::findOrFail($id);

        $this->color = [
            'id' => $model->id,
            'name' => $model->name,
        ];

        $this->resetValidation();
        $this->open_edit = true;
    }



    protected function rules()
    {
        return [
            'color.name'  => 'required|string|max:255|unique:colors,name,' . ($this->color['id'] ?? 'NULL'),
        ];
    }


    public function update()
    {
        $this->validate();

        $model = Color::findOrFail($this->color['id']);
        $model->name = $this->color['name'];
        $model->save();

        $this->reset(['open_edit', 'color']);
        $this->resetValidation();

        /* $this->dispatch('Actualizado', [
            'message' => 'Color actualizado con éxito.',
        ]); */

        $this->dispatch('swal:success', title: '¡Modificado!', text: 'El color se mofificó correctamente.');
    }

    public function cancelar()
    {
        $this->reset('open_edit', 'color');
        $this->resetValidation();
    }

    public function confirmarEliminado($id)
    {
        $this->colorid = $id;

        $this->dispatch('confirmareliminadooo');
        
    }


   #[On('eliminar')] // Escucha el evento "eliminar"
    public function delete()
    {
        //$this->authorize('delete', $user);
        if ($this->colorid) {
            $color = Color::find($this->colorid);
       
            if ($color) {
                $color->delete();

                // Notifica éxito
                $this->dispatch('borrado', [
                    'message' => 'Color eliminado con éxito.',
                ]);
            } else {
                // Notifica error si el usuario no existe
                $this->dispatch('borrado', [
                    'message' => 'color no encontrado.',
                    'type' => 'error',
                ]);
            }

            $this->reset('colorid');
        }
    }


    
}
