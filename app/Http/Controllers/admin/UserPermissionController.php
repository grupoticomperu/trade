<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class UserPermissionController extends Controller
{
    public function update(Request $request, User $user){
		//return $request->permissions;
        $user->permissions()->detach();//de eloquent, elimina todos los permisos
        if($request->filled('permissions')){//si escogio al menos un permiso
            $user->givePermissionTo($request->permissions);//guarda los escogidos
        }

		//$user->syncPermissions($request->permissions);//de la libreria
        //return back()->withFlash('Los Permisos fueron actualizados');
        session()->flash('swal', [
            'icon' => 'succes',
            'title' => 'Bien Hecho',
            'text' => 'Permisos del Usuario Actualizados Correctamente',
        ]);

        return redirect()->route('admin.users.edit', $user);



	}
}