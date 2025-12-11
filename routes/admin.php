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
use App\Livewire\Admin\ColorList;
use App\Livewire\Admin\Compras\ComprasList;
use App\Livewire\Admin\Crms\GanadosList;
use App\Livewire\Admin\Tipomarketings\Index as TipomarketingsIndex;
use App\Livewire\Admin\Distritos\Index as DistritosIndex;
//use App\Livewire\Admin\Tipomarketings\Create as TipomarketingsCreate;
//use App\Livewire\Admin\Tipomarketings\Edit as TipomarketingsEdit;
use App\Exports\CrmExport;
use App\Livewire\Admin\CombustibleList;
use App\Livewire\Admin\DistritoList;
use App\Livewire\Admin\EtapaList;
use App\Livewire\Admin\ModelloList;
use App\Livewire\Admin\ProveedorList;
use App\Livewire\Admin\TraccionList;
use App\Livewire\Admin\TransmisionList;
use App\Livewire\Admin\VersionList;
use App\Livewire\Admin\YearCrud;
use App\Livewire\Admin\YearList;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\Tipomarketing;

use App\Livewire\Admin\Leads\LeadEdit;
use App\Models\Lead;

Route::get('/hola', function () {
    return ('hola');
});
//creo debemos borrar esta ruta
Route::get('/inicio', function () {
    return view('admin.inicio');
});

Route::get('/tables', [TableController::class, 'showtables'])->name('admin.showtables');
Route::resource('users', UserController::class)->names('admin.users');
Route::resource('leads', LeadController::class)->middleware("can:viewAny," . Lead::class)->names('admin.leads');

Route::get('/leadss/{lead}/edit', LeadEdit::class)->name('leads.edit');

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


//Route::get('/tipomarketings', TipomarketingsIndex::class)->name('tipomarketings.index');

Route::get('/tipomarketings', TipomarketingsIndex::class)
    ->middleware("can:viewAny," . Tipomarketing::class)
    ->name('tipomarketings.index');


Route::get('/distritos', DistritosIndex::class)->name('distritos.index');
//Route::get('/tipomarketings/create', TipomarketingsCreate::class)->name('tipomarketings.create');
//Route::get('/tipomarketings/{tipomarketing}/edit', TipomarketingsEdit::class)->name('tipomarketings.edit');


Route::get('/brands', BrandList::class)->name('brand.list');

Route::get('/crmss/ganados', GanadosList::class)->name('admin.crms.ganados');

Route::get('/compras', ComprasList::class)->name('admin.compras.index');

Route::get('/colors', ColorList::class)->name('color.list');


Route::get('/export-crms', function () {
    return Excel::download(new CrmExport, 'crms.xlsx');
})->name('export.crms');


Route::get('/years', YearList::class)->name('year.list');

Route::get('/combustibles', CombustibleList::class)->name('combustible.list');

Route::get('/transmisions', TransmisionList::class)->name('transmision.list');
Route::get('/traccions', TraccionList::class)->name('traccion.list');

Route::get('/etapas', EtapaList::class)->name('etapa.list');   

Route::get('/modelos', ModelloList::class)->name('modello.list');   

Route::get('/versiones', VersionList::class)->name('version.list');  

Route::get('/proveedors-list', ProveedorList::class)->name('proveedor.list');  

//Route::get('/distritos', DistritoList::class)->name('distrito.list');  