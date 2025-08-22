<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\WithPagination;
use App\Models\Category;
use Livewire\Attributes\On;

class CategoryList extends Component
{
    use AuthorizesRequests;
    use WithPagination;
    public $search, $image, $category, $state, $identificador;
    public $sort = 'id';
    public $direction = 'desc';
    public $cant = '10';
    public $open_edit = false;
    public $readyToLoad = false; //para controlar el preloader inicia en false
    public $categoryid;

    protected $queryString = [
        'cant' => ['except' => '10'],
        'sort' => ['except' => 'id'],
        'direction' => ['except' => 'desc'],
        'search' => ['except' => ''],
    ];

    public function mount()
    {
        $this->identificador = rand();
        //$this->category = new Category();
        $this->image = "";
    }


    #[On('categoria-creada')] // Escucha el evento
    public function refreshList() {}


    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function loadCategories()
    {
        $this->readyToLoad = true;
    }




    public function render()
    {
        //$this->authorize('create', new Category);
        if ($this->readyToLoad) {

            $categories = Category::where('name', 'like', '%' . $this->search . '%')->paginate(10);
        } else {
            $categories = [];
        }
        return view('livewire.admin.category-list', compact('categories'))->layout('layouts.app');
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



    public function activar($categoryy)
    {

        Category::find($categoryy)
            ->update(['state' => 1]);
    }

    public function desactivar($categoryy)
    {

        Category::find($categoryy)
            ->update(['state' => 0]);
    }




    public function confirmarEliminado($id)
    {
        $this->categoryid = $id;

       

        $this->dispatch('confirmareliminado');
        //$this->dispatch('confirmareliminado', message:'¿Estás seguro de eliminar?');
        /* $this->dispatch('confirmareliminado', [
            'message' => '¿Estás seguro de eliminar este usuario?',
        ]); */
    }





    #[On('eliminar')] // Escucha el evento "eliminar"
    public function delete()
    {
        //$this->authorize('delete', $user);


        if ($this->categoryid) {
            $category = Category::find($this->categoryid);
            //$this->authorize('delete', $user);
            //dd($user);
            if ($category) {
                $category->delete();

                // Notifica éxito
                $this->dispatch('borrado', [
                    'message' => 'Categoria eliminada con éxito.',
                ]);
            } else {
                // Notifica error si el usuario no existe
                $this->dispatch('borrado', [
                    'message' => 'categoria no encontrado.',
                    'type' => 'error',
                ]);
            }

            $this->reset('categoryid');
        }
    }



}
