<?php

namespace App\Livewire\Admin;

use App\Exports\RoleExport;
use Livewire\Component;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\WithPagination;
use Spatie\Permission\Models\Role;
use Livewire\Attributes\On;

class RoleList extends Component
{
    use AuthorizesRequests;
    use WithPagination;

    public $role;
    public $roleid;
    public $search;
    public $sort='id';
    public $direction='desc';
    public $cant='10';


    public $readyToLoad = false;//para controlar el preloader inicia en false

    protected $queryString = [
        'cant'=>['except'=>'10'],
        'sort'=>['except'=>'id'],
        'direction'=>['except'=>'desc'],
        'search'=>['except'=>''],
    ];


    public function updatingSearch(){
        $this->resetPage();
        //RESETEA la paginación, updating() cuando se cambia una de las propiedades  updatingSearch() cuando se cambia la propiedad search
    }

    public function loadRoles(){
        $this->readyToLoad = true;
    }

    public function render()
    {

        if ($this->readyToLoad) {
            $roles = Role::where('name', 'like', '%' .$this->search. '%')
               ->orderBy($this->sort, $this->direction)
               ->paginate($this->cant);
       }else{
              $roles =[];
       }
       return view('livewire.admin.role-list', compact('roles'));
    }


    public function order($sort){
        if($this->sort == $sort){
            if($this->direction == 'desc'){
                $this->direction = 'asc';
            }else{
                $this->direction = 'desc';
            }
        }else{
            $this->sort = $sort;
            $this->direction = 'asc';
        }
    }


    public function activar(Role $role){
        $this->role = $role;

        $this->role->update([
            'state' => 1
        ]);
    }

     public function desactivar(Role $role){
        $this->role = $role;

        $this->role->update([
            'state' => 0
        ]);
    }

 /*    public function delete(Role $role){
    
        $role->delete();
    } */


    public function confirmarEliminado($id)
    {
        $this->roleid = $id;

        if ($this->roleid == 1) {
            //session()->flash('error', 'No puedes eliminar al superusuario.');
            $this->dispatch('nosepuedeborrarelroladmin');
            return;//poner este return para que no continue a la eliminación
        }

        $this->dispatch('confirmareliminado');
        //$this->dispatch('confirmareliminado', message:'¿Estás seguro de eliminar?');

    }

    #[On('eliminar')] // Escucha el evento "eliminar"
    public function delete()
    {
        
        if ($this->roleid) {
            $role = Role::find($this->roleid);
            $this->authorize('delete', $role);
            //dd($role);
            if ($role) {
                $role->delete();

                // Notifica éxito
                $this->dispatch('borrado', [
                    'message' => 'Rol eliminado con éxito.',
                ]);
            } else {
                // Notifica error si el usuario no existe
                $this->dispatch('borrado', [
                    'message' => 'Rol no encontrado.',
                    'type' => 'error',
                ]);
            }

            $this->reset('roleid');
        }
    }


    public function generateReport()
    {
        //dd("prueba");
        //return Excel::download(new UserExport(), 'users.xlsx');
        return new RoleExport();
    }



}
