<?php


namespace App\Livewire\Admin;

use Livewire\Component;

use Livewire\WithPagination;
use App\Models\User;
use Illuminate\Support\Facades\Storage;
use Illuminate\validation\Rule;
use Livewire\WithFileUploads;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class UserList extends Component
{

    use AuthorizesRequests;
    use WithPagination;
    //use WithFileUploads;
    public $user;
    public $search;
    public $sort = 'id';
    public $direction = 'desc';
    public $cant = '10';
    // public $open_edit = false;
    public $readyToLoad = false; //para controlar el preloader inicia en false

    // protected $listeners = ['render', 'delete'];

    protected $queryString = [
        'cant' => ['except' => '10'],
        'sort' => ['except' => 'id'],
        'direction' => ['except' => 'desc'],
        'search' => ['except' => ''],
    ];

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
        $this->authorize('view', new User);//probaremos poniendo en el controlador

        if ($this->readyToLoad) {
            /*  $users = User::where('name', 'like', '%' .$this->search. '%')
                ->orderBy($this->sort, $this->direction)
                ->paginate($this->cant); */
            $users = User::where('name', 'like', '%' . $this->search . '%')
                ->orderBy($this->sort, $this->direction)
                ->paginate($this->cant);
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



/*     public function activar(User $userr)
    {
        $this->user = $userr;
        dd($this->user);

        $this->user->update([
            'state' => 1
        ]);
    }

    public function desactivar(User $userr)
    {
        $this->user = $userr;
        dd($this->user);
        $this->user->update([
            'state' => 0
        ]);
    } */



}
