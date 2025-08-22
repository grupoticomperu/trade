<?php

namespace App\Livewire\Admin;

use App\Models\Crm;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Attributes\On;

class CrmList extends Component
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
    public $readyToLoad = false; //para controlar el preloader inicia en false

    protected $queryString = [
        'cant' => ['except' => '10'],
        'sort' => ['except' => 'id'],
        'direction' => ['except' => 'desc'],
        'search' => ['except' => ''],
    ];



    public function loadCrms()
    {
        $this->readyToLoad = true;
    }


    public function render()
    {
        $this->authorize('viewAny', Crm::class);

        $user = auth()->user();

        if ($this->readyToLoad) {
            if ($user->hasRole('Admin')) {
                // Admin ve todos
                $crms = Crm::latest()->paginate($this->cant);
            } else {
                // Usuario normal ve solo los suyos
                $crms = Crm::where('user_id', $user->id)
                    ->latest()
                    ->paginate($this->cant);
            }
        } else {
            $crms = collect(); // colección vacía, mejor que []
        }


        return view('livewire.admin.crm-list', compact('crms'));
    }
}
