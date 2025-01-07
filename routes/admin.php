<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\admin\TableController;
use App\Http\Controllers\admin\UserController;
use App\Http\Controllers\admin\UserPermissionController;
use App\Http\Controllers\admin\UserRoleController;

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