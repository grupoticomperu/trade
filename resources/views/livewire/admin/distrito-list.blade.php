<div wire:lazy>
    <x-slot name="header">
        <div class="flex items-center">
            <h2 class="text-xl font-semibold leading-tight text-gray-600">Lista de Distritos</h2>
        </div>
    </x-slot>

    <div class="container py-12 mx-auto border-gray-400 max-w-7xl sm:px-6 lg:px-8">
        <x-table>
            {{-- Barra de búsqueda y crear --}}
            <div class="items-center px-6 py-4 bg-gray-200 sm:flex">
                <div class="flex items-center justify-center mb-2 md:mb-0">
                    <span>Mostrar </span>
                    <select wire:model="cant"
                        class="block py-2.5 ml-3 mr-3 text-sm text-gray-900 border border-gray-300 rounded-lg">
                        <option value="10">10</option>
                        <option value="25">25</option>
                        <option value="50">50</option>
                    </select>
                    <span class="mr-3">registros</span>
                </div>

                <div class="flex items-center justify-center mb-2 mr-4 md:mb-0 sm:w-full">
                    <x-input type="text" wire:model.live="search"
                        class="flex items-center justify-center w-80 sm:w-full rounded-lg py-2.5"
                        placeholder="Buscar distrito..." />
                </div>

                @livewire('admin.distrito-create')
            </div>

            {{-- Tabla --}}
            @if (count($distritos))
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col"
                                class="w-24 px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase cursor-pointer"
                                wire:click="order('id')">
                                ID
                                @if ($sort == 'id')
                                    @if ($direction == 'asc')
                                        <i class="float-right mt-1 fas fa-sort-numeric-up"></i>
                                    @else
                                        <i class="float-right mt-1 fas fa-sort-numeric-down"></i>
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

                            <th class="px-6 py-3 text-xs font-medium tracking-wider text-right text-gray-500 uppercase">
                                Acciones
                            </th>
                        </tr>
                    </thead>

                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach ($distritos as $distrito)
                            <tr>
                                <td class="px-6 py-4 text-sm text-gray-500 whitespace-nowrap">
                                    {{ $distrito->id }}
                                </td>

                                <td class="px-6 py-4 text-sm text-gray-900 whitespace-nowrap">
                                    {{ $distrito->name }}
                                </td>

                                <td class="px-6 py-4 text-sm font-medium text-right whitespace-nowrap">
                                    <a wire:click="edit({{ $distrito->id }})" class="mr-1 btn btn-green">
                                        <i class="fa-solid fa-pen-to-square"></i>
                                    </a>
                                    <a class="btn btn-red" wire:click="confirmarEliminado({{ $distrito->id }})">
                                        <i class="fa-solid fa-trash-can"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                @if ($distritos->hasPages())
                    <div class="px-6 py-8">
                        {{ $distritos->links() }}
                    </div>
                @endif
            @else
                <div class="px-6 py-4 text-center">No hay distritos registrados</div>
            @endif
        </x-table>
    </div>

    {{-- Modal Editar --}}
    <x-dialog-modal wire:model="open_edit" maxWidth="md">
        <x-slot name="title">
            <div class="flex items-center space-x-2">
                <i class="fa-solid fa-pen-to-square text-blue-500"></i>
                <span>Editar Distrito</span>
            </div>
        </x-slot>

        <x-slot name="content">
            <div class="mb-4">
                <x-label value="Nombre del distrito" />
                <x-input type="text" class="w-full" wire:model="name" />
                <x-input-error for="name" />
            </div>
        </x-slot>

        <x-slot name="footer">
            <x-button wire:click="cancelar" class="mr-2">Cancelar</x-button>
            <x-danger-button wire:click="update" wire:loading.attr="disabled">Actualizar</x-danger-button>
        </x-slot>
    </x-dialog-modal>

    @push('scripts')
        <script>
            // ✅ Alerta de creación/actualización
            window.addEventListener('swal:success', event => {
                Swal.fire({
                    icon: 'success',
                    title: event.detail.title,
                    text: event.detail.text,
                    confirmButtonColor: '#3085d6'
                });
            });

            // ✅ Confirmar eliminación
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
                        Livewire.dispatch("eliminar");
                    }
                });
            });
        </script>
    @endpush
</div>
