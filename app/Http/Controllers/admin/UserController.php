<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\Position;
use App\Models\Local;
use App\Models\Employee;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Support\Facades\Storage;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests; // Importar el trait

use App\Models\Tenant;
use Spatie\Multitenancy\Models\Tenant as BaseTenant;

class UserController extends Controller
{
    use AuthorizesRequests, ValidatesRequests; // Usa el trait aquí explícitamente

    public function index()
    {
        $this->authorize('viewAny', User::class);
        return view('admin.users.index');
    }

    public function create()
    {
        $user = new User(); //instanvciamos el modelo user pero vacia
        $this->authorize('create', $user);
        $roles = Role::with('permissions')->get();
        //$permissions = Permission::pluck('name','id');
        $permissions = Permission::orderBy('model_name', 'asc')->get();
        $positions = Position::where('state', 1)->get(); //positions de la emresa
        $locales = Local::where('state', 1)->get(); //locales de la empresa
        return view('admin.users.create', compact('user', 'roles', 'permissions', 'positions', 'locales'));
    }


    public function store(Request $request)
    {

        $this->authorize('create', new User);
        $this->validate($request, [
            'name' => 'required |min:5',
            'email' => 'required|unique:users|email|max:100',
            'password' => 'required|confirmed|min:6',
            'photo' => 'image|max:2048'
        ]);

        if ($request->hasFile('photo')) {
            //dd($request->file('photo'));
            //$currentTenant = Tenant::current();
            //dd($currentTenant);
            $currentTenant = Tenant::current() ?? Tenant::defaultTenant();
            //dd($currentTenant);
            if ($currentTenant) {
                $databaseName = $currentTenant->database;

                // Construir la ruta basada en el nombre de la base de datos
                $path = "{$databaseName}/users";
                // Subir la imagen al bucket S3
                //$urlimage = Storage::disk('s3')->put($path, $request->file('photo'), 'public');//activar esta linea para s3
                $urlimage = $request->file('photo')->store($path);
                //$urlimage = $path;
                //dd($urlimage);
                //dd($request->file('photo'));
                //$filePath = $request->file('photo')->store($path, 's3'); // Guarda el archivo y devuelve su ruta
                //$urlimage = Storage::disk('s3')->url($filePath); // Construye la URL pública

            } else {
                throw new \Exception('No se encontró un inquilino activo.');
            }
            //$urlimage = Storage::disk('s3')->put($path, $request->file('photo'), 'public');
        } else {
            $urlimage = 'erpd/users/userdefault.jpg';
        }



        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            //'company_id'=> auth()->user()->employee->company->id,
        ]);

        Employee::create([
            'address' => $request->address,
            'movil' => $request->movil,
            'photo' => $urlimage,
            'dni' => $request->dni,
            'gender' => $request->gender,
            'birthdate' => $request->birthdate,
            'state' => $request->state,
            'user_id' => $user->id,
            'position_id' => $request->position_id,
            'local_id' => $request->local_id,
            //'company_id'=> auth()->user()->employee->company->id,

        ]);

        $user->assignRole($request->roles);
        // $user->givePermissionTo($request->permissions);
        $user->givePermissionTo($request->permissions);

        /* if ($request->has('permissions')) {
            $permissionNames = Permission::whereIn('id', $request->permissions)->pluck('name');
            $user->givePermissionTo($permissionNames);
        } */

        //return redirect()->route('admin.users.index')->withFlash('El Usuario fue creado');
        //return redirect()->route('admin.users.index')->with('success', 'El Usuario fue creado');

        /* session()->flash('swal', [
            'icon' => 'success',
            'title' => 'Bien Hecho',
            'text' => 'Usuario Creado Correctamente',
        ]); */


        //return redirect()->route('admin.users.index');

        return redirect()->route('admin.users.index')->with([
            'flash.banner' => 'El Usuario fue creado',
            'flash.bannerStyle' => 'success', // Estilo del banner (success, danger, warning, etc.)
        ]);

    }




    public function show(User $user)
    {
        $this->authorize('view', $user);
        $roles = Role::with('permissions')->get();
        //valor y no un array de objetos
        //$permissions = Permission::pluck('name','id');
        $permissions = Permission::orderBy('model_name', 'asc')->get();
        $positions = Position::all();
        $locales = Local::where('state', 1)->get(); //locales de la empresa
        return view('admin.users.show', compact('user', 'roles', 'permissions', 'positions', 'locales'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        $this->authorize('update', $user);
        //$roles = Role::pluck('name', 'id');//mandara un array asociativo con clave
        $roles = Role::with('permissions')->get();
        //valor y no un array de objetos
        //$permissions = Permission::pluck('name','id');
        $permissions = Permission::orderBy('model_name', 'asc')->get();
        $positions = Position::all();
        $locales = Local::where('state', 1)->get(); //locales de la empresa
        return view('admin.users.edit', compact('user', 'roles', 'permissions', 'positions', 'locales'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        $this->authorize('update', $user);
        // Validar los datos de entrada
        $this->validate($request, [
            'name' => 'required|min:5',
            'email' => 'required|email|max:200|unique:users,email,' . $user->id, // Ignorar email del usuario actual
            'password' => 'nullable|confirmed|min:6', // Password es opcional al actualizar
            'roles' => 'nullable|array',
            'permissions' => 'nullable|array',
            'photo' => 'nullable|image|max:2048',
        ]);

        // Manejo del archivo de foto
        if ($request->hasFile('photo')) {
            $currentTenant = Tenant::current() ?? Tenant::defaultTenant();
            if ($currentTenant) {
                $databaseName = $currentTenant->database;
                $path = "{$databaseName}/users";
                $urlimage = $request->file('photo')->store($path);

                // Actualizar la foto del usuario
                if ($user->employee->photo && $user->employee->photo != 'erpd/users/userdefault.jpg') {
                    Storage::delete($user->employee->photo); // Borra la foto anterior si existe
                }
            } else {
                throw new \Exception('No se encontró un inquilino activo.');
            }
        } else {
            $urlimage = $user->employee->photo; // Mantener la foto existente
        }


        // Actualizar los datos del usuario
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password ? Hash::make($request->password) : $user->password, // Solo actualiza si se envía un nuevo password
        ]);

        // Actualizar datos del empleado asociado
        $user->employee->update([
            'address' => $request->address,
            'movil' => $request->movil,
            'photo' => $urlimage,
            'dni' => $request->dni,
            'gender' => $request->gender,
            'birthdate' => $request->birthdate,
            'state' => $request->state,
            'position_id' => $request->position_id,
            'local_id' => $request->local_id,
        ]);
   


        session()->flash('swal', [
            'icon' => 'succes',
            'title' => 'Bien Hecho',
            'text' => 'Usuario Actualizado Correctamente',
        ]);

        //return redirect()->route('admin.users.index');
        return redirect()->route('admin.users.edit', $user);


    }

    public function destroy(User $user)
    {
        //
    }

    public function export()
    {
        return view('admin.users.export');
    }

    public function import()
    {
        return view('admin.users.import');
    }

}
