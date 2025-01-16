<?php

use Illuminate\Support\Facades\Route;
//use App\Http\Livewire\Probar;
use App\Livewire\Probar as LivewireProbar;
use App\Livewire\TestComponent;

Route::get('/probar', LivewireProbar::class)->name('probar.sweetalert');

Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});


Route::get('/test-component', TestComponent::class);