<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests; // Importar el trait

class RoleController extends Controller
{

    use AuthorizesRequests; // Usa el trait aquí explícitamente

    public function index()
    {
       $this->authorize('viewAny', Role::class);
       /*  return view('admin.roles.index', [
            'roles' => Role::all(),
        ]); */

        return view('admin.roles.index');

        
    }


    public function create()
    {
        $this->authorize('create', $role = new Role);
        $role = new Role;

        $permissions = Permission::orderBy('model_name', 'asc')->get();

        return view('admin.roles.create', [
            'permissions' => $permissions,
            'role' => $role
        ]);
    }


    public function store(Request $request)
    {
        $this->authorize('create', new Role);
        $role = new Role;


        $request->validate([
            'name' => 'required|unique:roles,name',
            'display_name' => 'required',
        ]);


        $role = Role::create([
            'name' => $request->name,
            'display_name' => $request->display_name,
            //'company_id' => auth()->user()->employee->company->id, //encontramos la company actual osea la compania del usuario logueado
            //'guard_name' => auth()->user()->employee->company->id,
        ]);

        if ($request->has('permissions')) {
            $role->givePermissionTo($request->permissions);
        }
        //return redirect()->route('admin.role.index')->withFlash('El Rol fue creado correctamente');

        session()->flash('swal', [
            'icon' => 'success',
            'title' => 'Bien Hecho',
            'text' => 'Rol Creado Correctamente',
        ]);


        return redirect()->route('admin.roles.index');
    }


    public function show(string $id)
    {
        //
    }


    public function edit(Role $role)
    {
        $this->authorize('update', $role);
        $permissions = Permission::orderBy('model_name', 'asc')->get();
        return view('admin.roles.edit', [
            'role' => $role,
            'permissions' => $permissions
        ]);
    }


    public function update(Request $request, Role $role)
    {
       $this->authorize('update', $role);
        $data = $request->validate([
            //'name'=>'required|unique:roles,name,' . $role->id,
            'display_name' => 'required',
            //'guard_name'=>'required'
        ]);

        $role->update($data);

        $role->permissions()->detach();
        if ($request->has('permissions')) {
            $role->givePermissionTo($request->permissions);
        }

        //return redirect()->route('admin.roles.edit', $role)->withFlash('El Rol fue actualizado correctamente');


        session()->flash('swal', [
            'icon' => 'success',
            'title' => 'Bien Hecho',
            'text' => 'Rol Actualizado Correctamente',
        ]);


        //return redirect()->route('admin.roles.index');
        return redirect()->route('admin.roles.edit', $role);



    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
