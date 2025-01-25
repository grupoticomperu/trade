<div>
    <div wire:init="loadRoles">

        <x-slot name="header">
            <div class="flex items-center">
                <h2 class="text-xl font-semibold leading-tight text-gray-600">
                    <a href="#" class="text-blue-600 no-underline flex items-center space-x-1">
                        <!-- Ícono de usuarios -->
                        <i class="fas fa-users"></i>
                        <span>{{ __('List Roles') }}</span>
                    </a>
                </h2>
            </div>
        </x-slot>

        <!-- This example requires Tailwind CSS v2.0+ -->
        <div class="container py-12 mx-auto border-gray-400 max-w-7xl sm:px-6 lg:px-8">

            <div class="items-center px-6 py-4 bg-gray-200 sm:flex">

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



                @can('Role Create')
                    <div class="flex items-center justify-center">
                        <a href="{{ route('admin.roles.create') }}"
                            class="items-center justify-center sm:flex btn btn-orange">
                            <i class="mx-2 fa-regular fa-file"></i> Nuevo
                        </a>

                    </div>




                    <a class="btn btn-red"  wire:click="generateReport">
                        generate Report
                    </a>
                @endcan


                {{-- <div class="flex items-center justify-center px-2 mt-2 mr-4 md:mt-0">

                                <x-input type="checkbox" wire:model="state" class="mx-1" />
                                Activos
                            </div> --}}

            </div>



            <x-table>


                {{-- @if ($brands->count()) --}}

                @if (count($roles))


                    <table class="min-w-full divide-y divide-gray-200 table-fixed">
                        <thead class="bg-gray-50">
                            <tr>

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

                                    Identificador
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
                                    wire:click="order('name')">

                                    Nombre
                                    @if ($sort == 'display_name')
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
                                    class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">
                                    Permisos
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




                                <th scope="col"
                                    class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">
                                    ACCIONES
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">

                            @foreach ($roles as $role)
                                <tr>

                                    <td class="px-6 py-4 text-sm text-gray-500 whitespace-nowrap">
                                        {{ $role->id }}
                                    </td>



                                    <td class="px-6 py-4 text-sm text-gray-500 whitespace-nowrap">



                                        {{ $role->name }}

                                    </td>




                                    <td class="px-6 py-4 text-sm text-gray-500 whitespace-nowrap">
                                        {{ $role->display_name }}
                                    </td>



                                    <td class="px-6 py-4 text-sm">


                                        {{ $role->permissions->pluck('display_name')->implode(', ') }}

                                    </td>



                                    <td class="px-6 py-4 text-sm font-medium text-right whitespace-nowrap">
                                        <a class="btn btn-blue"><i class="fa-sharp fa-solid fa-eye"></i></a>
                                        @can('Role Update')
                                            <a href="{{ route('admin.roles.edit', $role) }}" class="btn btn-green"><i
                                                    class="fa-solid fa-pen-to-square"></i></a>
                                        @endcan

                                        @can('Role Delete')
                                            @if ($role->id !== 1)
                                                <a class="btn btn-red" wire:click="confirmarEliminado({{ $role->id }})">
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




                    @if ($roles->hasPages())
                        <div class="px-6 py-4">
                            {{ $roles->links() }}
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


                window.addEventListener('nosepuedeborrarelroladmin', event => {
                    Swal.fire({
                        icon: "error",
                        title: "Oops...",
                        text: "Nose puede Eliminar al Rol Admin!",
                        footer: '<a href="#">WWW.TICOMPERU.COM</a>'
                    });
                });
            </script>
        @endpush

    </div>

</div>
