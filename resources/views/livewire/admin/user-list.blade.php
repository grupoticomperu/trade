<div>
    <div wire:init="loadUsers">

        <x-slot name="header">
            <!-- Cabecera principal -->
            <div class="bg-gray-100 p-2 rounded-lg shadow">
                <div class="flex justify-between items-center">
                    <!-- Título -->
                    <div class="flex items-center space-x-3">
                        <i class="fas fa-users text-blue-600 text-xl"></i>
                        <h1 class="text-2xl font-semibold text-gray-800"> {{ __('List Users') }}</h1>
                    </div>

                    <!-- Botones de acción -->
                    <div class="flex items-center space-x-4">
                        @can('User Create')
                            <a href="{{ route('admin.users.create') }}"
                                class="px-4 py-2 bg-orange-500 text-white rounded-lg hover:bg-orange-600 flex items-center space-x-2">
                                <i class="fa-solid fa-plus"></i>
                                <span>Nuevo</span>
                            </a>
                        @endcan
                    </div>
                </div>
            </div>
        </x-slot>

        <!-- Opciones adicionales -->
        <div class="container py-2 mx-auto border-gray-400 max-w-7xl sm:px-6 lg:px-8">

            {{--  @can('Banner Export') --}}
            <div class="p-4 mb-2 bg-white">
                {{-- <div class="flex items-center justify-between"> --}}
                <div class="flex flex-col items-center justify-between md:flex-row">


                    <div class="mb-2 md:mb-0 md:mr-4">
                        <x-button wire:click="confirmarEliminadogrupal"
                            class="items-center justify-center p-2 text-whit sm:flex btn btn-red">Eliminar
                            seleccionados</x-button>
                    </div>



                    {{-- <a href="{{ route('admin.users.create') }}"
                            class="px-4 py-2 bg-orange-500 text-white rounded-lg hover:bg-orange-600 flex items-center space-x-2">
                            <i class="fa-solid fa-plus"></i>
                            <span>Nuevo</span>
                        </a> --}}



                    <x-button wire:click="generateReport" class="mb-2 md:mb-0 md:mr-4">Exportar</x-jet-button>


                        <a class="inline-flex items-center px-4 py-2 mb-2 text-xs font-semibold tracking-widest text-white uppercase transition bg-gray-800 border border-transparent rounded-md md:mb-0 hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring focus:ring-gray-300 disabled:opacity-25"
                            href="{{ route('admin.users.pdf') }}" target="_blank">Reporte PDF</a>


                        <div class="mt-2 mb-2 text-center md:mt-0 md:ml-4">
                            <div class="box-border inline-block p-2 border-2 rounded-md">
                                <form action="" method="POST" enctype="multipart/form-data">
                                    @csrf

                                    {{-- <x-jet-validation-errors class="mb-4"> --}}

                                    <input type="file" name="file" accept=".csv, .xlxs">
                                    <x-button class="mt-2">Importar</x-button>
                                    <x-input-error for="file" />

                                </form>
                            </div>
                        </div>


                </div>
            </div>


            <div class="items-center px-6 py-2 bg-gray-200 sm:flex">

                <div class="flex items-center justify-center mb-2 md:mb-0">
                    <span>Mostrar </span>
                    <select wire:model.live="cant"
                        class="block p-7 py-2.5 ml-3 mr-3 text-sm text-gray-900 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">

                        <option value="10"> 10 </option>
                        <option value="25">25</option>
                        <option value="50">50</option>
                        <option value="100">100</option>
                    </select>
                    <span class="mr-3">registros</span>
                </div>


                <div class="flex items-center justify-center mb-2 mr-4 md:mb-0 sm:w-full">
                    <x-input type="text" wire:model.live="search"
                        class="flex items-center justify-center w-80 sm:w-full rounded-lg py-2.5"
                        placeholder="buscar" />
                </div>




                <div class="flex items-center justify-center px-2 mt-2 mr-4 md:mt-0">

                    <x-input type="checkbox" wire:model.live="showActive" class="mx-1" />
                    Activos
                    <x-input type="checkbox" wire:model.live="showInactive" class="mx-1" />
                    Inactivos
                </div>



            </div>




            <div class="items-center px-6 py-4 bg-gray-200 sm:flex">



                <div class="flex items-center justify-center px-2 mt-2 mr-4 md:mt-0">

                    <x-input type="checkbox" wire:model.live="created_at" class="mx-1" />
                    Fecha de Creación
                </div>



            </div>






        </div>





        <div class="container mx-auto py-0 max-w-7xl sm:px-6 lg:px-8">

            <x-table>

                {{-- @if ($brands->count()) --}}

                @if (count($users))


                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>

                                <th
                                    class="w-12 px-2 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase cursor-pointer">
                                    <x-input type="checkbox" wire:model.live="selectAll" class="mx-1" />

                                </th>

                                <th scope="col"
                                    class="w-24 px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase cursor-pointer"
                                    wire:click="order('id')">

                                    ID

                                    @if ($sort == 'id')
                                        @if ($direction == 'asc')
                                            <i class="float-right mt-1 fas fa-sort-alpha-up-alt"></i>
                                        @else
                                            <i class="float-right mt-1 fas fa-sort-alpha-down-alt"></i>
                                        @endif
                                    @else
                                        <i class="float-right mt-1 fas fa-sort"></i>
                                    @endif
                                </th>





                                <th scope="col"
                                    class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase cursor-pointer"
                                    wire:click="order('name')">

                                    Nombre
                                    @if ($sort == 'name')
                                        @if ($direction == 'asc')
                                            <i class="float-right mt-1 fas fa-sort-alpha-up-alt"></i>
                                        @else
                                            <i class="float-right mt-1 fas fa-sort-alpha-down-alt"></i>
                                        @endif
                                    @else
                                        <i class="float-right mt-1 fas fa-sort"></i>
                                    @endif

                                </th>



                                <th scope="col"
                                    class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase cursor-pointer"
                                    wire:click="order('email')">

                                    Email
                                    @if ($sort == 'email')
                                        @if ($direction == 'asc')
                                            <i class="float-right mt-1 fas fa-sort-alpha-up-alt"></i>
                                        @else
                                            <i class="float-right mt-1 fas fa-sort-alpha-down-alt"></i>
                                        @endif
                                    @else
                                        <i class="float-right mt-1 fas fa-sort"></i>
                                    @endif

                                </th>


                                <th scope="col"
                                    class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase ">
                                    Estado
                                    {{-- @if ($sort == 'state')
                                            @if ($direction == 'asc')
                                                <i class="float-right mt-1 fas fa-sort-alpha-up-alt"></i>
                                            @else
                                                <i class="float-right mt-1 fas fa-sort-alpha-down-alt"></i>
                                            @endif
                                        @else
                                            <i class="float-right mt-1 fas fa-sort"></i>
                                        @endif --}}


                                </th>


                                <th scope="col"
                                    class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase ">
                                    Roles
                                    {{-- @if ($sort == 'role')
                                            @if ($direction == 'asc')
                                                <i class="float-right mt-1 fas fa-sort-alpha-up-alt"></i>
                                            @else
                                                <i class="float-right mt-1 fas fa-sort-alpha-down-alt"></i>
                                            @endif
                                        @else
                                            <i class="float-right mt-1 fas fa-sort"></i>
                                        @endif --}}
                                </th>

                                @if ($created_at)
                                    <th scope="col"
                                        class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase cursor-pointer"
                                        wire:click="order('created_at')">
                                        Fecha de Creación
                                        @if ($sort == 'created_at')
                                            @if ($direction == 'asc')
                                                <i class="float-right mt-1 fas fa-sort-alpha-up-alt"></i>
                                            @else
                                                <i class="float-right mt-1 fas fa-sort-alpha-down-alt"></i>
                                            @endif
                                        @else
                                            <i class="float-right mt-1 fas fa-sort"></i>
                                        @endif

                                    </th>
                                @endif


                                <th scope="col"
                                    class="px-6 py-3 text-xs font-medium tracking-wider text-right text-gray-500 uppercase">
                                    ACCIONES
                                </th>
                            </tr>
                        </thead>



                        <tbody class="bg-white divide-y divide-gray-200">

                            @foreach ($users as $userr)
                                <tr>

                                    <td class="px-2 py-4 text-sm text-gray-500 ">

                                        {{-- <x-input type="checkbox" wire:model.live="selectedUsers.{{ $userr->id }}"
                                            class="mx-1" /> --}}
                                        <x-input type="checkbox" wire:model.live="selectedUsers.{{ $userr->id }}"
                                            class="mx-1" wire:key="user-checkbox-{{ $userr->id }}" />

                                    </td>

                                    <td class="px-6 py-4 text-sm text-gray-500 whitespace-nowrap">
                                        {{ $userr->id }}
                                    </td>

                                    <td class="flex items-center px-6 py-4 text-sm text-gray-500 whitespace-nowrap">

                                        <div class="flex-shrink-0 h-10 w-15 ">
                                            @if ($userr->employee)
                                                @if ($userr->employee->photo)
                                                    <img class="object-cover w-10 h-10 rounded-sm"
                                                        {{-- src="{{ Storage::disk('s3')->url($userr->employee->photo) }}"  --}}
                                                        src="{{ asset('img/' . $userr->employee->photo) }}"
                                                        alt="TICOM">
                                                @else
                                                    <img class="object-cover w-10 h-10 rounded-sm"
                                                        src="{{ asset('img/erp2025dic/users/default.jpg') }}"
                                                        alt="Usuario del Sistema">
                                                @endif
                                                {{-- src="{{ Storage::url($brand->image) }}" storage//storage/brand/default.jpg  en la bd esta puesto esto 	/storage/brands/default.jpg > --}}
                                                {{-- url($brand->image) muestra tal como es la ruta en la bd esta puesto esto 	/storage/brands/default.jpg --}}
                                                {{--  {{ Storage::disk("s3")->url($brand->image) }} --}}
                                                {{--  @else
                                                    <img class="object-cover w-10 h-10 rounded-full"
                                                        src="https://images.pexels.com/photos/4883800/pexels-photo-4883800.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=650&w=940"
                                                        alt=""> --}}
                                            @endif
                                        </div>
                                        <div class="ml-4">
                                            {{ $userr->name }}
                                        </div>
                                    </td>




                                    <td class="px-6 py-4 text-sm text-gray-500 whitespace-nowrap">
                                        {{ $userr->email }}
                                    </td>



                                    <td class="px-6 py-4 whitespace-nowrap">

                                        @switch($userr->state)
                                            @case(0)
                                                <span wire:click="activar({{ $userr->id }})"
                                                    class="inline-flex px-2 text-xs font-semibold leading-5 text-red-800 bg-red-100 rounded-full cursor-pointer">
                                                    inactivo
                                                </span>
                                            @break

                                            @case(1)
                                                <span wire:click="desactivar({{ $userr->id }})"
                                                    class="inline-flex px-2 text-xs font-semibold leading-5 text-green-800 bg-green-100 rounded-full cursor-pointer">
                                                    activo
                                                </span>
                                            @break

                                            @default
                                        @endswitch

                                    </td>

                                    <td>{{ $userr->getRoleNames()->implode(', ') }}</td>

                                    @if ($created_at)
                                        <td class="px-6 py-4 text-sm text-gray-500 whitespace-nowrap">
                                            {{ $userr->created_at }}
                                        </td>
                                    @endif

                                    <td class="px-6 py-4 text-sm font-medium text-right whitespace-nowrap">
                                        @can('User View')
                                            <a href="{{ route('admin.users.show', $userr) }}" class="btn btn-blue"><i
                                                    class="fa-sharp fa-solid fa-eye"></i></a>
                                        @endcan
                                        @can('User Update')
                                            <a href="{{ route('admin.users.edit', $userr) }}" class="btn btn-green"><i
                                                    class="fa-solid fa-pen-to-square"></i></a>
                                        @endcan

                                        @can('User Delete')
                                            {{-- <a class="btn btn-red" wire:click="confirmDelete({{ $userr->id }})">
                                            <i class="fa-solid fa-trash-can"></i>
                                        </a> --}}
                                            @if ($userr->id !== 1)
                                                {{-- Ocultar el botón para el superusuario --}}
                                                <a class="btn btn-red"
                                                    wire:click="confirmarEliminado({{ $userr->id }})">
                                                    <i class="fa-solid fa-trash-can"></i>
                                                </a>
                                            @endif
                                        @endcan


                                    </td>
                                </tr>
                            @endforeach
                            <!-- More people... -->
                        </tbody>
                    </table>




                    @if ($users->hasPages())
                        <div class="px-6 py-4">
                            {{ $users->links() }}
                        </div>
                    @endif
                @else
                    {{-- <div wire:init="loadUsers">

                                </div> --}}


                    @if ($readyToLoad)
                        <div class="px-6 py-4">
                            <div class="flex items-center justify-center">
                                No hay ningún registro coincidente
                            </div>
                        </div>
                    @else
                        <div class="px-6 py-4">
                            <div class="flex items-center justify-center">
                                <svg class="w-10 h-10 animate-spin" xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 512 512" fill="blue">

                                    <path
                                        d="M304 48c0-26.5-21.5-48-48-48s-48 21.5-48 48s21.5 48 48 48s48-21.5 48-48zm0 416c0-26.5-21.5-48-48-48s-48 21.5-48 48s21.5 48 48 48s48-21.5 48-48zM48 304c26.5 0 48-21.5 48-48s-21.5-48-48-48s-48 21.5-48 48s21.5 48 48 48zm464-48c0-26.5-21.5-48-48-48s-48 21.5-48 48s21.5 48 48 48s48-21.5 48-48zM142.9 437c18.7-18.7 18.7-49.1 0-67.9s-49.1-18.7-67.9 0s-18.7 49.1 0 67.9s49.1 18.7 67.9 0zm0-294.2c18.7-18.7 18.7-49.1 0-67.9S93.7 56.2 75 75s-18.7 49.1 0 67.9s49.1 18.7 67.9 0zM369.1 437c18.7 18.7 49.1 18.7 67.9 0s18.7-49.1 0-67.9s-49.1-18.7-67.9 0s-18.7 49.1 0 67.9z" />
                                </svg>
                            </div>
                        </div>

                        <div class="px-6 py-4">
                            <div class="flex items-center justify-center">
                                Cargando, espere un momento
                            </div>
                        </div>
                    @endif




                @endif





            </x-table>
        </div>

    </div>


    <x-slot name="footer">

        <h2 class="text-xl font-semibold leading-tight text-gray-600">
            Pie
        </h2>


    </x-slot>




    @push('scripts')
        {{-- <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script> --}}


        <script>
            window.addEventListener('confirmareliminado', event => {
                Swal.fire({
                    title: event.detail.message,
                    text: "No se podrá revertir!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Sí, eliminar!",
                    cancelButtonText: "Cancelar"
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Emitir el evento 'eliminar' al backend
                        //$wire.dispatch('eliminar');
                        //console.log('Emitir evento eliminar'); // Verificar en la consola
                        //Livewire.emit("eliminar");
                        Livewire.dispatch("eliminar");
                    }
                });
            });

            window.addEventListener('borrado', event => {
                Swal.fire({
                    title: "Mensaje del Sistema",
                    text: event.detail.message || "Registro eliminado correctamente.",
                    icon: "success",
                });
            });



            window.addEventListener('nosepuedeborraralsuperusuario', event => {
                Swal.fire({
                    icon: "error",
                    title: "Oops...",
                    text: "Nose puede Eliminar al Super Usuario!",
                    footer: '<a href="#">WWW.TICOMPERU.COM</a>'
                });
            });


            window.addEventListener('confirmareliminadogrupal', event => {
                Swal.fire({
                    title: event.detail.message,
                    text: "No se podrá revertir!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Sí, eliminar!",
                    cancelButtonText: "Cancelar"
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Emitir el evento 'eliminar' al backend
                        //$wire.dispatch('eliminar');
                        //console.log('Emitir evento eliminar'); // Verificar en la consola
                        //Livewire.emit("eliminar");
                        Livewire.dispatch("eliminargrupal");
                    }
                });
            });

            window.addEventListener('borradogrupal', event => {
                Swal.fire({
                    title: "Mensaje del Sistema",
                    text: event.detail.message || "eliminado correctamente.",
                    icon: "success",
                });
            });

            window.addEventListener('noescogiste', event => {
                Swal.fire({
                    title: "Mensaje del Sistema",
                    text: event.detail.message || "No escogiste ningun registro o escogiste al admin.",
                    icon: "success",
                });
            });

            /*  $wire.on('confirmareliminado', function() =>{
                         Swal.fire({
                             title:"eliminadooor",
                             text: "No se podrá revertir!",
                             icon: "warning",
                             showCancelButton: true,
                             confirmButtonColor: "#3085d6",
                             cancelButtonColor: "#d33",
                             confirmButtonText: "Sí, eliminar!",
                             cancelButtonText: "Cancelar"
                         }).then((result) => {
                             if (result.isConfirmed) {
                    
                                 $wire.dispatch('eliminar');
                             }
                         });

                     });


                     $wire.on('borrado', function(message){
                         Swal.fire({
                             title: "Mensaje del Sistema",
                             text: "xyz",
                             icon: "success",
                         });

                     });  */



            /* window.addEventListener('confirmareliminado', event => {
                        Swal.fire({
                            title: event.detail.message,
                            text: "No se podrá revertir!",
                            icon: "warning",
                            showCancelButton: true,
                            confirmButtonColor: "#3085d6",
                            cancelButtonColor: "#d33",
                            confirmButtonText: "Sí, eliminar!",
                            cancelButtonText: "Cancelar"
                        }).then((result) => {
                            if (result.isConfirmed) {
                              
                                $wire.dispatch("eliminar");
                            }
                        });
                    });
            
                    window.addEventListener('borrado', event => {
                        Swal.fire({
                            title: "Mensaje del Sistema",
                            text: "xyz",
                            icon: "success",
                            
                        });
                    });   */



           
        </script>
    @endpush




</div>

</div>
