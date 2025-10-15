<div wire:lazy>
    <x-slot name="header">
        <div class="flex items-center">
            <h2 class="text-xl font-semibold leading-tight text-gray-600">
                Lista de Modelos
            </h2>
        </div>
    </x-slot>

    <div class="container py-12 mx-auto border-gray-400 max-w-7xl sm:px-6 lg:px-8">
        <x-table>
            {{-- 🔸 Filtros y botón Nuevo --}}
            <div class="items-center px-6 py-4 bg-gray-200 sm:flex">
                <div class="flex items-center justify-center mb-2 md:mb-0">
                    <span>Mostrar </span>
                    <select wire:model="cant"
                        class="block p-7 py-2.5 ml-3 mr-3 text-sm text-gray-900 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500">
                        <option value="10">10</option>
                        <option value="25">25</option>
                        <option value="50">50</option>
                        <option value="100">100</option>
                    </select>
                    <span class="mr-3">registros</span>
                </div>

                <div class="flex items-center justify-center mb-2 mr-4 md:mb-0 sm:w-full">
                    <x-input type="text" wire:model.live="search"
                        class="flex items-center justify-center w-80 sm:w-full rounded-lg py-2.5"
                        placeholder="Buscar modelo o marca" />
                </div>

                @livewire('admin.modello-create')
            </div>

            {{-- 🔸 Tabla --}}
            @if (count($modellos))
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            {{-- ID --}}
                            <th scope="col"
                                class="w-24 px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase cursor-pointer"
                                wire:click="order('id')">
                                ID
                                @if ($sort == 'id')
                                    @if ($direction == 'asc')
                                        <i class="float-right mt-1 fas fa-sort-numeric-up-alt"></i>
                                    @else
                                        <i class="float-right mt-1 fas fa-sort-numeric-down-alt"></i>
                                    @endif
                                @else
                                    <i class="float-right mt-1 fas fa-sort"></i>
                                @endif
                            </th>

                            {{-- MODELO --}}
                            <th scope="col"
                                class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase cursor-pointer"
                                wire:click="order('name')">
                                Modelo
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

                            {{-- MARCA --}}
                            <th scope="col"
                                class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase cursor-pointer"
                                wire:click="order('brand_id')">
                                Marca
                                @if ($sort == 'brand_id')
                                    @if ($direction == 'asc')
                                        <i class="float-right mt-1 fas fa-sort-alpha-up-alt"></i>
                                    @else
                                        <i class="float-right mt-1 fas fa-sort-alpha-down-alt"></i>
                                    @endif
                                @else
                                    <i class="float-right mt-1 fas fa-sort"></i>
                                @endif
                            </th>

                            {{-- ACCIONES --}}
                            <th scope="col"
                                class="px-6 py-3 text-xs font-medium tracking-wider text-right text-gray-500 uppercase">
                                ACCIONES
                            </th>
                        </tr>
                    </thead>

                    {{-- 🔸 Cuerpo de la tabla --}}
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach ($modellos as $modello)
                            <tr>
                                <td class="px-6 py-4 text-sm text-gray-500 whitespace-nowrap">
                                    {{ $modello->id }}
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-900 whitespace-nowrap">
                                    {{ $modello->name }}
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-900 whitespace-nowrap">
                                    {{ $modello->brand?->name ?? '—' }}
                                </td>

                                <td class="px-6 py-4 text-sm font-medium text-right whitespace-nowrap">
                                    <a wire:click="edit({{ $modello->id }})" class="mr-1 btn btn-green">
                                        <i class="fa-solid fa-pen-to-square"></i>
                                    </a>
                                    <a class="btn btn-red" wire:click="confirmarEliminado({{ $modello->id }})">
                                        <i class="fa-solid fa-trash-can"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                {{-- 🔸 Paginación --}}
                @if ($modellos->hasPages())
                    <div class="px-6 py-8">
                        {{ $modellos->links() }}
                    </div>
                @endif
            @else
                <div class="px-6 py-4">No hay ningún registro coincidente</div>
            @endif
        </x-table>
    </div>

    {{-- 🔸 Modal de edición --}}
    <x-dialog-modal wire:model="open_edit">
        <x-slot name="title">Modificando el Modelo</x-slot>

        <x-slot name="content">
            <div class="mb-4">
                <x-label value="Nombre del modelo" />
                <x-input type="text" class="w-full" wire:model="name" />
                <x-input-error for="name" />
            </div>

            <div class="mb-4">
                <x-label value="Marca asociada" />
                <select wire:model="brand_id"
                    class="w-full p-2 mt-1 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500">
                    <option value="">-- Seleccionar marca --</option>
                    @foreach ($brands as $brand)
                        <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                    @endforeach
                </select>
                <x-input-error for="brand_id" />
            </div>
        </x-slot>

        <x-slot name="footer">
            <x-button wire:click="cancelar" class="mr-2">
                <i class="mx-2 fa-sharp fa-solid fa-xmark"></i> Cancelar
            </x-button>
            <x-danger-button wire:click="update" wire:loading.attr="disabled">
                <i class="mx-2 fa-regular fa-floppy-disk"></i> Guardar
            </x-danger-button>
        </x-slot>
    </x-dialog-modal>

    {{-- 🔸 Scripts --}}
    @push('scripts')
        <script>
            window.addEventListener('swal:success', event => {
                Swal.fire({
                    icon: 'success',
                    title: event.detail.title,
                    text: event.detail.text,
                    confirmButtonColor: '#3085d6'
                });
            });

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
