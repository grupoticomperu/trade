<div>

    <x-slot name="header">
        <div class="flex items-center">
            <h2 class="text-xl font-semibold leading-tight text-gray-600">
                Lista de Distritos
            </h2>
        </div>
    </x-slot>
    <div class="container py-12 mx-auto border-gray-400 max-w-7xl sm:px-6 lg:px-8">
        <x-table>

           


            <div class="items-center px-6 py-4 bg-gray-200 sm:flex">

                <div class="flex items-center justify-center mb-2 md:mb-0">
                    <span>Mostrar </span>
                    <select wire:model.live="perPage"
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



               {{--  @can('Distrito Create') --}}
                    @livewire('admin.distritos.create')
               {{--  @endcan --}}


            </div>


            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                    <thead class="bg-gray-50 dark:bg-gray-900">
                        <tr>
                            <th class="px-4 py-2 text-left text-xs font-semibold uppercase tracking-wider cursor-pointer"
                                wire:click="sortBy('id')">
                                ID
                                @if ($sortField === 'id')
                                    <span class="ml-1">{{ $sortDirection === 'asc' ? '▲' : '▼' }}</span>
                                @endif
                            </th>
                            <th class="px-4 py-2 text-left text-xs font-semibold uppercase tracking-wider cursor-pointer"
                                wire:click="sortBy('name')">
                                Nombre
                                @if ($sortField === 'name')
                                    <span class="ml-1">{{ $sortDirection === 'asc' ? '▲' : '▼' }}</span>
                                @endif
                            </th>

                            <th class="px-4 py-2 text-right text-xs font-semibold uppercase tracking-wider">Acciones
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                        @forelse ($distritos as $row)
                            <tr>
                                <td class="px-4 py-2">{{ $row->id }}</td>
                                <td class="px-4 py-2">{{ $row->name }}</td>

                                <td class="px-4 py-2 text-right space-x-2">
                                    {{--  <a href="{{ route('tipomarketings.edit', $row) }}"
                                        class="px-3 py-1 rounded-lg bg-amber-500/90 text-white hover:bg-amber-600">Editar</a> --}}
                                    <a wire:click="edit({{ $row->id }})" class="mr-1 btn btn-green">
                                        <i class="fa-solid fa-pen-to-square"></i>
                                    </a>
                                    {{-- <button type="button" wire:click="confirmDelete({{ $row->id }})"
                                        class="px-3 py-1 rounded-lg bg-rose-600 text-white hover:bg-rose-700">Eliminar</button> --}}
                                    <a class="btn btn-red" wire:click="confirmarEliminado({{ $row->id }})">
                                        <i class="fa-solid fa-trash-can"></i>
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="px-4 py-6 text-center text-gray-500 dark:text-gray-300">Sin
                                    resultados.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>


            <div>
                {{ $distritos->onEachSide(1)->links() }}
            </div>


        </x-table>
    </div>



    <x-dialog-modal wire:model="open_edit">
        <x-slot name="title">
            Modificando el Distrito
        </x-slot>

        <x-slot name="content">
            <div class="mb-4">
                <x-label value="Tipo Marketing" />
                <x-input type="text" class="w-full" wire:model.live="distrito.name" />
                {{-- clave anidada --}}
                <x-input-error for="distrito.name" />
            </div>


        </x-slot>

        <x-slot name="footer">
            <x-button wire:click="cancelar" class="mr-2">
                <i class="mx-2 fa-sharp fa-solid fa-xmark"></i>Cancelar
            </x-button>

            <x-danger-button wire:click="update" wire:loading.attr="disabled" class="disabled:opacity-25">
                <i class="mx-2 fa-regular fa-floppy-disk"></i> Guardar
            </x-danger-button>
        </x-slot>
    </x-dialog-modal>

    {{-- SweetAlert2 listeners --}}
    <script>
        


        window.addEventListener('confirmareliminadooo', event => {
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



        window.addEventListener('swal:success', event => {
            Swal.fire({
                icon: 'success',
                title: event.detail.title,
                text: event.detail.text,
                confirmButtonColor: '#3085d6'
            });
        });
    </script>



</div>
