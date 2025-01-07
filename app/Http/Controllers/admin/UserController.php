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
        //$companyId = auth()->user()->employee->company->id;
        $user = new User(); //instanvciamos el modelo user pero vacia
        //$this->authorize('create', $user);
        $roles = Role::with('permissions')->get();
        $permissions = Permission::pluck('name','id');
        $positions = Position::where('state', 1)->get();//positions de la emresa
        $locales = Local::where('state', 1)->get();//locales de la empresa
        return view('admin.users.create', compact('user', 'roles', 'permissions', 'positions', 'locales'));

    }


    public function store(Request $request)
    {

        /* try {
            $filePath = $request->file('photo')->store('test-folder', 's3'); // Guarda el archivo
            $url = Storage::disk('s3')->url($filePath); // Obtén la URL pública
            dd(['filePath' => $filePath, 'url' => $url]);
        } catch (\Exception $e) {
            dd("Error: " . $e->getMessage());
        } */

       /*  try {
            $result = Storage::disk('s3')->put('test-folder/test-file.txt', 'This is a test file', 'public');
            dd($result ? "Connection successful: File uploaded." : "Connection failed.");
        } catch (\Exception $e) {
            dd("Error: " . $e->getMessage());
        } */

        /* dd([
            'AWS_ACCESS_KEY_ID' => env('AWS_ACCESS_KEY_ID'),
            'AWS_SECRET_ACCESS_KEY' => env('AWS_SECRET_ACCESS_KEY'),
            'AWS_DEFAULT_REGION' => env('AWS_DEFAULT_REGION'),
            'AWS_BUCKET' => env('AWS_BUCKET'),
        ]); */
        

        //$this->authorize('create', new User);
        //$company = auth()->user()->employee->company;


        $this->validate($request, [
            'name' => 'required |min:5',
            'email' => 'required|unique:users|email|max:100',
            'password' => 'required|confirmed|min:6',
            'photo' => 'image|max:2048'
        ]);


        if($request->hasFile('photo'))
        {
            //dd($request->file('photo'));
            //$currentTenant = Tenant::current();
            //dd($currentTenant);
            $currentTenant = Tenant::current() ?? Tenant::defaultTenant();
            //dd($currentTenant);
            if ($currentTenant) {
                $databaseName = $currentTenant->database;

                // Construir la ruta basada en el nombre de la base de datos
                $path = "{$databaseName}/users";
                //dd($path);

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
        }else{
             $urlimage = 'erpd/users/userdefault.jpg';
        }


        /* if ($request->hasFile('photo')) {
            try {
                $path = Storage::disk('s3')->put('erpd/users', $request->file('photo'), 'public');
                if (!$path) {
                    throw new \Exception("Failed to upload file to S3.");
                }
                $urlimage = Storage::disk('s3')->url($path);
            } catch (\Exception $e) {
                dd($e->getMessage()); // Captura el mensaje de error
            }
        } else {
            $urlimage = 'https://ticomperut.s3.sa-east-1.amazonaws.com/erpd/users/userdefault.jpg';
        } */

        $user = User::create([
            'name'=> $request ->name,
            'email' => $request -> email,
            'password' => Hash::make( $request -> password ),
            //'company_id'=> auth()->user()->employee->company->id,
        ]);

        Employee::create([
            'address'=> $request ->address,
            'movil'=> $request ->movil,
            'photo' => $urlimage,
            'dni'=> $request ->dni,
            'gender'=> $request ->gender,
            'birthdate'=> $request ->birthdate,
            'state'=> $request ->state,
            'user_id'=> $user ->id,
            'position_id'=> $request->position_id,
            'local_id'=> $request->local_id,
            //'company_id'=> auth()->user()->employee->company->id,

        ]);

        $user->assignRole($request->roles);
        $user->givePermissionTo($request->permissions);
        return redirect()->route('admin.users.index')->withFlash('El Usuario fue creado');
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
       // $companyId = auth()->user()->employee->company->id;
        //$this->authorize('update', $user);
        //$roles = Role::pluck('name', 'id');//mandara un array asociativo con clave
        $roles = Role::with('permissions')->get();
        //valor y no un array de objetos
        $permissions = Permission::pluck('name','id');
        $positions = Position::all();
        $locales = Local::where('state', 1)->get();//locales de la empresa
         return view('admin.users.edit', compact('user', 'roles', 'permissions', 'positions', 'locales'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        //
    }
}