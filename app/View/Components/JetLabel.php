<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class JetLabel extends Component
{
    public $for;
    public $value;

    public function __construct($for = null, $value = null)
    {
        $this->for = $for;
        $this->value = $value;
    }

    public function render(): View|Closure|string
    {
        return view('components.jet-label');
    }
}
