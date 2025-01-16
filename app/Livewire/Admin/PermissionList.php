<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Livewire\WithPagination;
use Spatie\Permission\Models\Permission;


class PermissionList extends Component
{

    use WithPagination;

    //protected $listeners = ['render', 'delete'];

    public $permissionId;
    public $name;
    public $display_name;

    public $search, $permission;
    public $sort = 'id';
    public $direction = 'desc';
    public $cant = '10';
    public $open_edit = false;
    public $readyToLoad = false; //para cntrolar el preloader
    public $flag;

    protected $queryString = [
        'cant' => ['except' => '10'],
        'sort' => ['except' => 'id'],
        'direction' => ['except' => 'desc'],
        'search' => ['except' => ''],
    ];

    protected $rules = [
        'permission.name' => 'required',
        'permission.display_name' => 'required',
    ];

    public function updatingSearch()
    {
        $this->resetPage();
    }


    public function loadPermissions()
    {
        $this->readyToLoad = true;
    }

    public function render()
    {

        if ($this->readyToLoad) {
            $permissions = Permission::where('name', 'like', '%' . $this->search . '%')
                ->orWhere('display_name', 'like', '%' . $this->search . '%')
                ->orderBy($this->sort, $this->direction)
                ->paginate($this->cant);
        } else {
            $permissions = [];
        }
        return view('livewire.admin.permission-list', compact('permissions'))->layout('layouts.app');
        //return view('livewire.admin.permission-list')->layout('layouts.app');
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

    public function edit(Permission $permission)
    {
        //$this->permission = $permission;
        
        $this->permissionId = $permission->id;
        $this->name = $permission->name;
        $this->display_name = $permission->display_name;

        $this->open_edit = true;
    }

   /*  public function update()
    {
        $this->validate();
        $this->permission->save();
        $this->reset('open_edit');

        $this->emitTo('show-posts', 'render');
        $this->emit('alert', 'El Permiso se modifico correctamente');
    } */

    public function update()
    {
        $this->validate([
            'name' => 'required',
            'display_name' => 'required',
        ]);
    
        $permission = Permission::findOrFail($this->permissionId);
        $permission->name = $this->name;
        $permission->display_name = $this->display_name;
        $permission->save();
    
        /* session()->flash('swal', [
            'icon' => 'success',
            'title' => 'Bien Hecho',
            'text' => 'Permiso Actualizado Correctamente',
        ]); */


        $this->reset('open_edit', 'name', 'display_name');

        return redirect()->route('admin.permissions.list')->with([
            'flash.banner' => 'El Permiso fue actualizado',
            'flash.bannerStyle' => 'success', // Estilo del banner (success, danger, warning, etc.)
        ]);
       // $this->emit('alert', 'El permiso se modificó correctamente');
    }





}
