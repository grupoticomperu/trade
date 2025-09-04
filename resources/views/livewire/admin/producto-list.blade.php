<div>
    <div wire:init="loadProductos">

        <x-slot name="header">
            <!-- Cabecera principal -->
            <div class="bg-gray-100 p-2 rounded-lg shadow">
                <div class="flex justify-between items-center">
                    <!-- Título -->
                    <div class="flex items-center space-x-3">
                        <i class="fas fa-users text-blue-600 text-xl"></i>
                        <h1 class="text-2xl font-semibold text-gray-800"> {{ __('Lista de Productos') }}</h1>
                    </div>

                    <!-- Botones de acción -->
                    <div class="flex items-center space-x-4">
                        @can('producto Create')
                            <a href="{{ route('admin.productos.create') }}"
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
            {{-- <div class="p-4 mb-2 bg-white">
                <div class="flex flex-col items-center justify-between md:flex-row">
                    <x-button wire:click="generateReport" class="mb-2 md:mb-0 md:mr-4">Importar</x-jet-button>
                </div>
            </div> --}}

            <div class="items-center px-6 py-2 bg-gray-200 sm:flex">

                <div class="flex items-center px-6 py-2 bg-gray-200">
                    <span>Mostrar </span>
                    <select wire:model.live="cant" class="ml-2 mr-2 border rounded">
                        <option value="10">10</option>
                        <option value="25">25</option>
                        <option value="50">50</option>
                    </select>
                    <span>registros</span>

                    <x-input type="text" wire:model.live="search" class="ml-4 w-80"
                        placeholder="Buscar producto..." />

                    <div class="flex items-center gap-4 ml-6">
                        <p class="font-medium">Estado</p>
                        <label><input type="radio" value="all" wire:model.live="stateFilter"> Todos</label>
                        <label><input type="radio" value="disp" wire:model.live="stateFilter"> Disponible</label>
                        <label><input type="radio" value="res" wire:model.live="stateFilter"> Reservado</label>
                        <label><input type="radio" value="vend" wire:model.live="stateFilter"> Vendido</label>
                        <label><input type="radio" value="comp" wire:model.live="stateFilter"> Comprado</label>
                    </div>
                </div>







            </div>
        </div>

        <div class="container mx-auto py-0 max-w-7xl sm:px-6 lg:px-8">

            <x-table>

                @if (count($productos))

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

                               {{--  <th scope="col"
                                    class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase cursor-pointer"
                                    wire:click="order('nombre')">

                                    Nombre
                                    @if ($sort == 'nombre')">
                                        @if ($direction == 'asc')
                                            <i class="float-right mt-1 fas fa-sort-alpha-up-alt"></i>
                                        @else
                                            <i class="float-right mt-1 fas fa-sort-alpha-down-alt"></i>
                                        @endif
                                    @else
                                        <i class="float-right mt-1 fas fa-sort"></i>
                                    @endif

                                </th> --}}

                                <th scope="col"
                                    class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase cursor-pointer"
                                    wire:click="order('placa')">

                                    Placa
                                    @if ($sort == 'placa')
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
                                    Precio Esperado
                                </th>

                                <th scope="col"
                                    class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase ">
                                    Estado
                                </th>

                                <th scope="col"
                                    class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase ">
                                    Precio Ofertado
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase ">
                                    Dueño
                                </th>

                                <th scope="col"
                                    class="px-6 py-3 text-xs font-medium tracking-wider text-right text-gray-500 uppercase">
                                    ACCIONES
                                </th>
                            </tr>
                        </thead>


                        <tbody class="bg-white divide-y divide-gray-200">

                            @foreach ($productos as $producto)
                                <tr>
                                    <td class="px-6 py-4 text-sm text-gray-500 whitespace-nowrap">
                                        {{ $producto->id }}
                                    </td>

                                    {{-- <td class="flex items-center px-6 py-4 text-sm text-gray-500 whitespace-nowrap">


                                        <div class="ml-4">
                                            {{ $producto->nombre }}
                                        </div>
                                    </td> --}}

                                    <td class="px-6 py-4 text-sm text-gray-500 whitespace-nowrap">
                                        {{ $producto->placa }}
                                    </td>

                                    <td>
                                        @if($producto->precio_esperado )
                                            US$ {{ $producto->precio_esperado }}
                                        @endif
                                        
                                    </td>

                                    <td class="px-6 py-4 whitespace-nowrap">

                                        @switch($producto->state)
                                            @case(0)
                                                <span wire:click="cambiarEstado({{ $producto->id }},1)"
                                                    class="px-2 py-1 bg-green-100 text-green-700 rounded cursor-pointer">Disponible</span>
                                            @break

                                            @case(1)
                                                <span wire:click="cambiarEstado({{ $producto->id }},2)"
                                                    class="px-2 py-1 bg-yellow-100 text-yellow-700 rounded cursor-pointer">Reservado</span>
                                            @break

                                            @case(2)
                                                <span wire:click="cambiarEstado({{ $producto->id }},3)"
                                                    class="px-2 py-1 bg-red-100 text-red-700 rounded cursor-pointer">Vendido</span>
                                            @break

                                            @case(3)
                                                <span class="px-2 py-1 bg-gray-200 text-gray-700 rounded">Comprado</span>
                                            @break
                                        @endswitch

                                    </td>

                                    <td>
                                        {{ $producto->precio_ofertado }}
                                    </td>

                                    <td>
                                        {{ $producto->proveedor->nombre }}
                                    </td>

                                    @if ($created_at)
                                        <td class="px-6 py-4 text-sm text-gray-500 whitespace-nowrap">
                                            {{ $producto->created_at }}
                                        </td>
                                    @endif

                                    <td class="px-6 py-4 text-sm font-medium text-right whitespace-nowrap">



                                        @can('Producto Update')
                                            <a href="{{ route('admin.productos.edit', $producto) }}"
                                                class="btn btn-green"><i class="fa-solid fa-pen-to-square"></i></a>
                                        @endcan

                                        @can('Producto Delete')
                                            {{-- <a class="btn btn-red" wire:click="confirmDelete({{ $producto->id }})">
                                            <i class="fa-solid fa-trash-can"></i>
                                        </a> --}}

                                            {{-- Ocultar el botón para el superusuario --}}
                                            <a class="btn btn-red" wire:click="confirmarEliminado({{ $producto->id }})">
                                                <i class="fa-solid fa-trash-can"></i>
                                            </a>
                                        @endcan


                                    </td>
                                </tr>
                            @endforeach
                            <!-- More people... -->
                        </tbody>
                    </table>

                    @if ($productos->hasPages())
                        <div class="px-6 py-4">
                            {{ $Productos->links() }}
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
