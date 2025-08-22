<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Attributes\On;

use App\Models\Lead;

class LeadList extends Component
{

    use AuthorizesRequests;
    use WithPagination;
    //use WithFileUploads;
    public $lead;
    public $leadid;
    public $search;
    public $sort = 'id';
    public $direction = 'desc';
    public $cant = 10;
    public $state;
    public $showActive = false;
    public $showInactive = false;
    // public $open_edit = false;
    public $readyToLoad = false; //para controlar el preloader inicia en false
    public $created_at;
    public $selectedUsers = []; //para eliminar en grupo
    public $selectAll = false; //para eliminar en grupo
    public string $stateFilter = 'all';


    protected $queryString = [
        'cant' => ['except' => '10'],
        'sort' => ['except' => 'id'],
        'direction' => ['except' => 'desc'],
        'search' => ['except' => ''],
    ];

    // Método para restablecer la selección después de eliminar
    private function resetSelected()
    {
        $this->selectAll = false;
        $this->selectedUsers = [];
    }


    public function updatingSearch()
    {
        $this->resetPage();
        //RESETEA la paginación, updating() cuando se cambia una de las propiedades  updatingSearch() cuando se cambia la propiedad search
    }

    public function loadLeads()
    {
        $this->readyToLoad = true;
    }


    // Si paginas resultados:
    public function updatedStateFilter()
    {
        $this->resetPage();
    }


    public function render()
    {


        $this->authorize('viewAny', Lead::class);

        $user = auth()->user();
        $query = Lead::query()
            ->where('esoportunidad', 0)
            ->where('nombres', 'like', '%' . $this->search . '%')
            ->when($this->stateFilter === 'active', fn($q) => $q->where('state', 1))
            ->when($this->stateFilter === 'inactive', fn($q) => $q->where('state', 0));

        if (!$user->hasRole('Admin')) {
            $query->where('user_id', $user->id);  // ← solo los suyos
        }

        $leads = $query->orderBy($this->sort, $this->direction)->paginate($this->cant);



        return view('livewire.admin.lead-list', compact('leads'));
    }


    public function activar($leadId)
    {
        $lead = Lead::findOrFail($leadId); // Buscar el usuario por ID
        $lead->update(['state' => Lead::STATE_ACTIVE]); // Actualizar el estado a activo
    }

    public function desactivar($leadId)
    {
        $lead = Lead::findOrFail($leadId); // Buscar el usuario por ID
        $lead->update(['state' => Lead::STATE_INACTIVE]); // Actualizar el estado a inactivo
    }


    public function confirmarEliminado($id)
    {
        $this->leadid = $id;



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


        if ($this->leadid) {
            $lead = Lead::find($this->leadid);
            $this->authorize('delete', $lead);
            //dd($user);
            if ($lead) {
                $lead->delete();

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

            $this->reset('leadid');
        }
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
}
