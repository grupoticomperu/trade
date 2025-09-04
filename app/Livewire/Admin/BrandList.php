<?php

namespace App\Livewire\Admin;

use Livewire\Component;

use App\Models\Brand;
use Illuminate\Support\Str;
use App\Exports\BrandExport;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use Illuminate\validation\Rule;
use App\Models\Configuration;
use Livewire\Attributes\On;

use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

//php artisan make:livewire admin/BrandList
class BrandList extends Component
{

    use WithPagination; //para paginacion
    use AuthorizesRequests; //para permisos
    use WithFileUploads; //para la carga de imagenes
    public $search, $image, $brand, $identificador; //identificador para recargar la imagen

    public $order, $name, $state;
    public $sort = 'id';
    public $direction = 'desc';
    public $cant = '10';
    public $open_edit = false;
    //public $open_view = false;
    public $readyToLoad = false; //para controlar el preloader inicia en false
    public $brandid;


    protected $queryString = [
        'cant' => ['except' => '10'],
        'sort' => ['except' => 'id'],
        'direction' => ['except' => 'desc'],
        'search' => ['except' => ''],
    ];


    #[On('marca-creada')] // Escucha el evento
    public function refreshList() {
          $this->resetPage();
    }


    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function loadBrands()
    {
        $this->readyToLoad = true;
    }







    public function render()
    {

        if ($this->readyToLoad) {

            $brands = Brand::where('name', 'like', '%' . $this->search . '%')->paginate(10);
        } else {
            $brands = [];
        }

        return view('livewire.admin.brand-list', compact('brands'))->layout('layouts.app');
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



    public function activar($brand)
    {

        Brand::find($brand)
            ->update(['state' => 1]);
    }

    public function desactivar($brand)
    {
        Brand::find($brand)
            ->update(['state' => 0]);
    }


    public function confirmarEliminado($id)
    {
        $this->brandid = $id;



        $this->dispatch('confirmareliminadooo');
        //$this->dispatch('confirmareliminado', message:'¿Estás seguro de eliminar?');
        /* $this->dispatch('confirmareliminado', [
            'message' => '¿Estás seguro de eliminar este usuario?',
        ]); */
    }


    #[On('eliminar')] // Escucha el evento "eliminar"
    public function delete()
    {
        //$this->authorize('delete', $user);


        if ($this->brandid) {
            $brand = Brand::find($this->brandid);
            //$this->authorize('delete', $user);
            //dd($user);
            if ($brand) {
                $brand->delete();

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

            $this->reset('brandid');
        }
    }
}
