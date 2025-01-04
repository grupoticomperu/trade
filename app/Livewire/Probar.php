<?php

namespace App\Livewire;

use Livewire\Component;

class Probar extends Component
{

    public function triggerAlert()
    {
        $this->dispatchBrowserEvent('alert', [
            'type' => 'success',
            'message' => '¡Hola! Este es un SweetAlert desde Livewire.'
        ]);
    }



    public function render()
    {
        return view('livewire.probar')->layout('layouts.app');;
    }
}
