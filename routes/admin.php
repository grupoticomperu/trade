<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\admin\TableController;
use App\Http\Controllers\admin\UserController;
use App\Http\Controllers\admin\UserPermissionController;
use App\Http\Controllers\admin\UserRoleController;
use App\Livewire\Admin\PermissionList;
//use App\Livewire\Counter;
use App\Http\Controllers\admin\RoleController;

Route::get('/hola', function () {
    return ('hola');
});
//creo debemos borrar esta ruta
Route::get('/inicio', function () {
    return view('admin.inicio');
});

Route::get('/tables', [TableController::class, 'showtables'])->name('admin.showtables');
Route::resource('users', UserController::class)->names('admin.users');

Route::middleware('tenant')->group(function() {
    // routes
});



//Route::put('users/{user}/roles', [UserRoleController::class, 'update'])->name('admin.users.roles.update')->middleware('role:Admin');
//Route::put('users/{user}/permissions', [UserPermissionController::class, 'update'])->name('admin.users.permissions.update')->middleware('role:Admin');
Route::put('users/{user}/roles', [UserRoleController::class, 'update'])->name('admin.users.roles.update');
Route::put('users/{user}/permissions', [UserPermissionController::class, 'update'])->name('admin.users.permissions.update');
Route::get('/permission', PermissionList::class)->name('admin.permissions.list');
Route::resource('roles', RoleController::class)->names('admin.roles');


//Route::get('/counter', Counter::class);
