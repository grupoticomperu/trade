<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\admin\TableController;
use App\Http\Controllers\admin\UserController;
use App\Http\Controllers\admin\UserPermissionController;
use App\Http\Controllers\admin\UserRoleController;
use App\Livewire\Admin\PermissionList;
//use App\Livewire\Counter;
use App\Http\Controllers\admin\RoleController;
use App\Livewire\Admin\CategoryList;
use App\Http\Controllers\admin\LeadController;
use App\Http\Controllers\admin\CrmController;
use App\Http\Controllers\admin\ProductoController;
use App\Http\Controllers\admin\ProveedorController;
use App\Http\Controllers\admin\SeguimientoController;
use App\Livewire\Admin\BrandList;
use App\Livewire\Admin\Compras\ComprasList;
use App\Livewire\Admin\Crms\GanadosList;
use App\Livewire\Admin\Tipomarketings\Index as TipomarketingsIndex;
use App\Livewire\Admin\Tipomarketings\Create as TipomarketingsCreate;
use App\Livewire\Admin\Tipomarketings\Edit as TipomarketingsEdit;

Route::get('/hola', function () {
    return ('hola');
});
//creo debemos borrar esta ruta
Route::get('/inicio', function () {
    return view('admin.inicio');
});

Route::get('/tables', [TableController::class, 'showtables'])->name('admin.showtables');
Route::resource('users', UserController::class)->names('admin.users');
Route::resource('leads', LeadController::class)->names('admin.leads');
Route::resource('crms', CrmController::class)->names('admin.crms');
Route::resource('proveedors', ProveedorController::class)->names('admin.proveedors')->parameters(['proveedors' => 'proveedor']);
Route::resource('productos', ProductoController::class)->names('admin.productos');

Route::get('/admin/leads/import', [LeadController::class, 'form'])->name('admin.leads.import.form');
Route::post('/admin/leads/import', [LeadController::class, 'import'])->name('admin.leads.import');



//Route::put('users/{user}/roles', [UserRoleController::class, 'update'])->name('admin.users.roles.update')->middleware('role:Admin');
//Route::put('users/{user}/permissions', [UserPermissionController::class, 'update'])->name('admin.users.permissions.update')->middleware('role:Admin');
Route::put('users/{user}/roles', [UserRoleController::class, 'update'])->name('admin.users.roles.update');
Route::put('users/{user}/permissions', [UserPermissionController::class, 'update'])->name('admin.users.permissions.update');
Route::get('/permission', PermissionList::class)->name('admin.permissions.list');
Route::resource('roles', RoleController::class)->names('admin.roles');

//Route::get('/users/export', [UserController::class, 'export'])->name('admin.users.export');
//Route::get('/users/import', [UserController::class, 'import'])->name('admin.users.import');

Route::get('/userspdf/pdf', [UserController::class, 'generatepdf'])->name('admin.users.pdf');

//categorias
Route::get('/categories', CategoryList::class)->name('category.list');

//Route::get('/leads', [LeadController::class, 'index'])->name('admin.leads');

Route::get('admin/crms/createe/{email?}/{placa?}', [CrmController::class, 'createe'])->name('admin.crms.createe');

Route::resource('crms.seguimientos', SeguimientoController::class)
        ->parameters(['crms' => 'crm', 'seguimientos' => 'seguimiento'])
        ->names('admin.crms.seguimientos')
        ->shallow();
        
        
Route::get('/tipomarketings', TipomarketingsIndex::class)->name('tipomarketings.index');
Route::get('/tipomarketings/create', TipomarketingsCreate::class)->name('tipomarketings.create');
Route::get('/tipomarketings/{tipomarketing}/edit', TipomarketingsEdit::class)->name('tipomarketings.edit');


Route::get('/brands', BrandList::class)->name('brand.list');

Route::get('/crmss/ganados', GanadosList::class)->name('admin.crms.ganados');

Route::get('/compras', ComprasList::class)->name('admin.compras.index');
