<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\admin\TableController;
use App\Http\Controllers\admin\UserController;

Route::get('/hola', function () {
    return ('hola');
});

Route::get('/inicio', function () {
    return view('admin.inicio');
});

Route::get('/tables', [TableController::class, 'showtables'])->name('admin.showtables');
Route::resource('users', UserController::class)->names('admin.users');

Route::middleware('tenant')->group(function() {
    // routes
});