<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserRoleController extends Controller
{
    public function update(Request $request, User $user)
    {
        //roles es el array con los datos de los roles[]
        //syncRoles es un metodo de laravelpermission
        $user->syncRoles($request->roles);
        //redireccionar
        //return back()->withFlash('Los Roles fueron actualizados');


        session()->flash('swal', [
            'icon' => 'succes',
            'title' => 'Bien Hecho',
            'text' => 'Roles del Usuario Actualizados Correctamente',
        ]);

        return redirect()->route('admin.users.edit', $user);



    }
}