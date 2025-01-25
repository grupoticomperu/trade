<?php


namespace App\Livewire\Admin;

use Livewire\Component;

use Livewire\WithPagination;
use App\Models\User;
use Illuminate\Support\Facades\Storage;
use Illuminate\validation\Rule;
use Livewire\WithFileUploads;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Attributes\On;

//use Barryvdh\DomPDF\Facade\Pdf;

use App\Exports\UserExport;
//use Maatwebsite\Excel\Facades\Excel;

class UserList extends Component
{

    use AuthorizesRequests;
    use WithPagination;
    //use WithFileUploads;
    public $user;
    public $userid;
    public $search;
    public $sort = 'id';
    public $direction = 'desc';
    public $cant = '3';
    public $state;
    public $showActive = false;
    public $showInactive = false;
    // public $open_edit = false;
    public $readyToLoad = false; //para controlar el preloader inicia en false
    public $created_at;
    public $selectedUsers = []; //para eliminar en grupo
    public $selectAll = false; //para eliminar en grupo

    // protected $listeners = ['render', 'delete'];
    //protected $listeners = ['render', 'delete'];
    //protected $listeners = ['eliminar' => 'delete', 'notify'];

    protected $queryString = [
        'cant' => ['except' => '3'],
        'sort' => ['except' => 'id'],
        'direction' => ['except' => 'desc'],
        'search' => ['except' => ''],
    ];


    // Método para seleccionar/deseleccionar todos
    public function updatedSelectAll($value)
    {
        if ($value) {
            $this->selectedUsers = User::pluck('id')->mapWithKeys(function ($id) {
                return [$id => true];
            })->toArray();
        } else {
            $this->selectedUsers = [];
        }
        //mapWithKeys(function ($id) { return [$id => true]; })
        //Estamos utilizando el método mapWithKeys para transformar el array de IDs en un array asociativo donde
        //cada ID es la clave y el valor es establecido como verdadero. Esto se hace para representar las marcas seleccionadas
    }






    // Método para restablecer la selección después de eliminar
    private function resetSelected()
    {
        $this->selectAll = false;
        $this->selectedUsers = [];
    }



    public function updatedShowActive($value)
    {
        if ($value) {
            $this->showInactive = false;
        }
    }

    public function updatedShowInactive($value)
    {
        if ($value) {
            $this->showActive = false;
        }
    }



    public function generateReport()
    {
        //dd("prueba");
        //return Excel::download(new UserExport(), 'users.xlsx');
        return new UserExport();
    }

    public function updatingSearch()
    {
        $this->resetPage();
        //RESETEA la paginación, updating() cuando se cambia una de las propiedades  updatingSearch() cuando se cambia la propiedad search
    }

    public function loadUsers()
    {
        $this->readyToLoad = true;
    }


    public function render()
    {
        $this->authorize('viewAny', User::class); //probaremos poniendo en el controlador

        if ($this->readyToLoad) {
            $users = User::where('name', 'like', '%' . $this->search . '%')
                ->when($this->showActive && !$this->showInactive, function ($query) {
                    // Filtrar solo activos
                    return $query->where('state', 1);
                })
                ->when($this->showInactive && !$this->showActive, function ($query) {
                    // Filtrar solo inactivos
                    return $query->where('state', 0);
                })
                ->orderBy($this->sort, $this->direction)
                ->paginate($this->cant);
            // Actualizar selectAll basado en los usuarios seleccionados
            // $this->selectAll = count($this->selectedUsers) === $users->total();
        } else {
            $users = [];
        }
        return view('livewire.admin.user-list', compact('users'));
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

    public function activar($userId)
    {
        $user = User::findOrFail($userId); // Buscar el usuario por ID
        $user->update(['state' => User::STATE_ACTIVE]); // Actualizar el estado a activo
    }

    public function desactivar($userId)
    {
        $user = User::findOrFail($userId); // Buscar el usuario por ID
        $user->update(['state' => User::STATE_INACTIVE]); // Actualizar el estado a inactivo
    }




    public function confirmarEliminado($id)
    {
        $this->userid = $id;

        if ($this->userid == 1) {
            //session()->flash('error', 'No puedes eliminar al superusuario.');
            $this->dispatch('nosepuedeborraralsuperusuario');
            return; //poner este return para que no continue a la eliminación
        }

        $this->dispatch('confirmareliminado');
        //$this->dispatch('confirmareliminado', message:'¿Estás seguro de eliminar?');
        /* $this->dispatch('confirmareliminado', [
            'message' => '¿Estás seguro de eliminar este usuario?',
        ]); */
    }

    public function confirmarEliminadogrupal()
    {

        $this->dispatch('confirmareliminadogrupal');
    }

    #[On('eliminar')] // Escucha el evento "eliminar"
    public function delete()
    {
        //$this->authorize('delete', $user);


        if ($this->userid) {
            $user = User::find($this->userid);
            $this->authorize('delete', $user);
            //dd($user);
            if ($user) {
                $user->delete();

                // Notifica éxito
                $this->dispatch('borrado', [
                    'message' => 'Usuario eliminado con éxito.',
                ]);
            } else {
                // Notifica error si el usuario no existe
                $this->dispatch('borrado', [
                    'message' => 'Usuario no encontrado.',
                    'type' => 'error',
                ]);
            }

            $this->reset('userid');
        }
    }



    // Método para eliminar marcas seleccionadas
    #[On('eliminargrupal')] // Escucha el evento "eliminar"
    public function deleteSelected()
    {
        //$this->authorize('update', User::class); // Asegúrate de tener permisos para eliminar

        $selectedIds = array_keys(array_filter($this->selectedUsers));
        //dd($selectedIds );
        // Excluir el ID del superusuario (id = 1)
        $filteredIds = array_filter($selectedIds, function ($id) {
            return $id != 1;
        });


        if (!empty($filteredIds)) {
            User::whereIn('id', $filteredIds)->delete();

            $this->resetSelected();
            $this->dispatch('borradogrupal', [
                'message' => 'Usuario eliminado con éxito.',
                'type' => 'success',
            ]);
            //$this->emit('alert', 'Las marcas seleccionadas se eliminaron correctamente');
        } else {
            // Notifica error si el usuario no existe
            $this->dispatch('noescogiste', [
                'message' => 'No escogiste para eliminar.',
                'type' => 'error',
            ]);
        }
    }
}
