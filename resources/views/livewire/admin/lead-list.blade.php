<div>
    <div wire:init="loadLeads">

        <x-slot name="header">
            <!-- Cabecera principal -->
            <div class="bg-gray-100 p-2 rounded-lg shadow">
                <div class="flex justify-between items-center">
                    <!-- Título -->
                    <div class="flex items-center space-x-3">
                        <i class="fas fa-users text-blue-600 text-xl"></i>
                        <h1 class="text-2xl font-semibold text-gray-800"> {{ __('Lista de Leads') }}</h1>
                    </div>

                    <!-- Botones de acción -->
                    <div class="flex items-center space-x-4">
                        @can('Lead Create')
                            <a href="{{ route('admin.leads.create') }}"
                                class="px-4 py-2 bg-orange-500 text-white rounded-lg hover:bg-orange-600 flex items-center space-x-2">
                                <i class="fa-solid fa-plus"></i>
                                <span>Nuevo</span>
                            </a>
                        @endcan


                        {{-- @can('Lead Create') --}}
                        <a href="{{ route('admin.leads.import.form') }}"
                            class="px-4 py-2 bg-orange-500 text-white rounded-lg hover:bg-orange-600 flex items-center space-x-2">
                            <i class="fa-solid fa-plus"></i>
                            <span>Importar</span>
                        </a>
                        {{-- @endcan --}}

                    </div>
                </div>
            </div>
        </x-slot>

        <!-- Opciones adicionales -->
        <div class="container py-2 mx-auto border-gray-400 max-w-7xl sm:px-6 lg:px-8">

            {{--  @can('Banner Export') --}}
            {{-- <div class="p-4 mb-2 bg-white">
                <div class="flex flex-col items-center justify-between md:flex-row">
                    <x-button wire:click="generateReport" class="mb-2 md:mb-0 md:mr-4">Importar</x-jet-button>
                </div>
            </div> --}}

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




                {{-- <div class="flex items-center justify-center px-2 mt-2 mr-4 md:mt-0">
                    <p>Perfil Coincide</p>
                    <x-input type="checkbox" wire:model.live="showActive" class="mx-1" />
                    Si
                    <x-input type="checkbox" wire:model.live="showInactive" class="mx-1" />
                    No
                </div> --}}


                <div class="flex items-center gap-4 px-2 mt-2 mr-4 md:mt-0">
                    <p class="font-medium">Perfil coincide</p>

                    <label class="inline-flex items-center gap-2">
                        <input type="radio" name="stateFilter" value="all" wire:model.live="stateFilter"
                            class="rounded">
                        <span>Todos</span>
                    </label>

                    <label class="inline-flex items-center gap-2">
                        <input type="radio" name="stateFilter" value="active" wire:model.live="stateFilter"
                            class="rounded">
                        <span>Sí</span>
                    </label>

                    <label class="inline-flex items-center gap-2">
                        <input type="radio" name="stateFilter" value="inactive" wire:model.live="stateFilter"
                            class="rounded">
                        <span>No</span>
                    </label>
                </div>



            </div>
        </div>

        <div class="container mx-auto py-0 max-w-7xl sm:px-6 lg:px-8">

            <x-table>

                @if (count($leads))

                    <table class="min-w-full divide-y divide-gray-200">
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
                                    wire:click="order('nombres')">

                                    Nombres
                                    @if ($sort == 'nombres')">
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
                                    wire:click="order('correoelectronico')">

                                    Email
                                    @if ($sort == 'correoelectronico')
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
                                    Placa
                                </th>

                                <th scope="col"
                                    class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase ">
                                    Perfil Coincide
                                </th>

                                <th scope="col"
                                    class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase ">
                                    Telefono
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase ">
                                    Usuario
                                </th>

                                <th scope="col"
                                    class="px-6 py-3 text-xs font-medium tracking-wider text-right text-gray-500 uppercase">
                                    ACCIONES
                                </th>
                            </tr>
                        </thead>


                        <tbody class="bg-white divide-y divide-gray-200">

                            @foreach ($leads as $lead)
                                <tr>
                                    <td class="px-6 py-4 text-sm text-gray-500 whitespace-nowrap">
                                        {{ $lead->id }}
                                    </td>

                                    <td class="flex items-center px-6 py-4 text-sm text-gray-500 whitespace-nowrap">


                                        <div class="ml-4">
                                            {{ $lead->nombres }}
                                        </div>
                                    </td>

                                    <td class="px-6 py-4 text-sm text-gray-500 whitespace-nowrap">
                                        {{ $lead->correoelectronico }}
                                    </td>

                                    <td>
                                        {{ $lead->placa }}
                                    </td>

                                    <td class="px-6 py-4 whitespace-nowrap">

                                        @switch($lead->state)
                                            @case(0)
                                                <span wire:click="activar({{ $lead->id }})"
                                                    class="inline-flex px-2 text-xs font-semibold leading-5 text-red-800 bg-red-100 rounded-full cursor-pointer">
                                                    No
                                                </span>
                                            @break

                                            @case(1)
                                                <span wire:click="desactivar({{ $lead->id }})"
                                                    class="inline-flex px-2 text-xs font-semibold leading-5 text-green-800 bg-green-100 rounded-full cursor-pointer">
                                                    Si
                                                </span>
                                            @break

                                            @default
                                        @endswitch

                                    </td>

                                    <td>
                                        {{ $lead->telefono }}
                                    </td>

                                    <td>
                                        @if($lead->user)
                                        {{ $lead->user->name }}
                                        @else
                                        <p>Sin user</p>
                                        @endif
                                    </td>

                                    @if ($created_at)
                                        <td class="px-6 py-4 text-sm text-gray-500 whitespace-nowrap">
                                            {{ $lead->created_at }}
                                        </td>
                                    @endif

                                    <td class="px-6 py-4 text-sm font-medium text-right whitespace-nowrap">

                                        @can('Lead View')
                                            {{--  <a href="{{ route('admin.crms.index') }}" class="btn btn-blue"><i
                                                    class="fa-sharp fa-solid fa-eye"></i></a> --}}


                                            @php
                                                $email = trim($lead->correoelectronico ?? '');
                                                $placa = trim($lead->placa ?? '');
                                                $user_id = $lead->user_id ?? NULL;
                                                $ready = filter_var($email, FILTER_VALIDATE_EMAIL) && $placa !== '' && $user_id !== NULL;
                                            @endphp

                                            @if ($ready)
                                                <a href="{{ route('admin.crms.createe', ['email' => $email, 'placa' => $placa]) }}"
                                                    class="btn btn-blue">
                                                    <i class="fa-solid fa-arrow-right"></i>
                                                </a>
                                            @else
                                                <button type="button" class="btn btn-blue opacity-50 cursor-not-allowed"
                                                    title="Completa email y placa para continuar" disabled>
                                                    <i class="fa-solid fa-arrow-right"></i>
                                                </button>
                                            @endif


                                            {{-- <a href="{{ route('admin.crms.createe', [$lead->correoelectronico, $lead->placa]) }}"
                                                class="btn btn-blue">
                                                <i class="fa-solid fa-arrow-right"></i>
                                            </a>  --}}
                                        @endcan

                                        @can('Lead Update')
                                            <a href="{{ route('admin.leads.edit', $lead) }}" class="btn btn-green"><i
                                                    class="fa-solid fa-pen-to-square"></i></a>
                                        @endcan

                                        @can('Lead Delete')
                                            {{-- <a class="btn btn-red" wire:click="confirmDelete({{ $lead->id }})">
                                            <i class="fa-solid fa-trash-can"></i>
                                        </a> --}}

                                            {{-- Ocultar el botón para el superusuario --}}
                                            <a class="btn btn-red" wire:click="confirmarEliminado({{ $lead->id }})">
                                                <i class="fa-solid fa-trash-can"></i>
                                            </a>
                                        @endcan


                                    </td>
                                </tr>
                            @endforeach
                            <!-- More people... -->
                        </tbody>
                    </table>

                    @if ($leads->hasPages())
                        <div class="px-6 py-4">
                            {{ $leads->links() }}
                        </div>
                    @endif
                @else
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
        </script>
    @endpush

</div>

</div>
