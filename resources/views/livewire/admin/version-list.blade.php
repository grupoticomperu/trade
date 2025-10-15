<div wire:lazy>
    <x-slot name="header">
        <div class="flex items-center">
            <h2 class="text-xl font-semibold leading-tight text-gray-600">
                Lista de Versiones
            </h2>
        </div>
    </x-slot>

    <div class="container py-12 mx-auto border-gray-400 max-w-7xl sm:px-6 lg:px-8">
        <x-table>
            {{-- 🔸 Barra superior --}}
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
                        placeholder="Buscar versión, modelo o marca" />
                </div>

                @livewire('admin.version-create')
            </div>

            {{-- 🔸 Tabla --}}
            @if (count($versions))
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            {{-- Versión --}}
                            <th scope="col"
                                class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase cursor-pointer"
                                wire:click="order('name')">
                                Versión
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

                            {{-- Modelo --}}
                            <th scope="col"
                                class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase cursor-pointer"
                                wire:click="order('modello_name')">
                                Modelo
                                @if ($sort == 'modello_name')
                                    @if ($direction == 'asc')
                                        <i class="float-right mt-1 fas fa-sort-alpha-up-alt"></i>
                                    @else
                                        <i class="float-right mt-1 fas fa-sort-alpha-down-alt"></i>
                                    @endif
                                @else
                                    <i class="float-right mt-1 fas fa-sort"></i>
                                @endif
                            </th>

                            {{-- Marca --}}
                            <th scope="col"
                                class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase cursor-pointer"
                                wire:click="order('brand_name')">
                                Marca
                                @if ($sort == 'brand_name')
                                    @if ($direction == 'asc')
                                        <i class="float-right mt-1 fas fa-sort-alpha-up-alt"></i>
                                    @else
                                        <i class="float-right mt-1 fas fa-sort-alpha-down-alt"></i>
                                    @endif
                                @else
                                    <i class="float-right mt-1 fas fa-sort"></i>
                                @endif
                            </th>

                            {{-- Acciones --}}
                            <th scope="col"
                                class="px-6 py-3 text-xs font-medium tracking-wider text-right text-gray-500 uppercase">
                                ACCIONES
                            </th>
                        </tr>
                    </thead>

                    {{-- Cuerpo --}}
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach ($versions as $version)
                            <tr>
                                <td class="px-6 py-4 text-sm text-gray-900 whitespace-nowrap">
                                    {{ $version->name }}
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-900 whitespace-nowrap">
                                    {{ $version->modello?->name ?? '—' }}
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-900 whitespace-nowrap">
                                    {{ $version->modello?->brand?->name ?? '—' }}
                                </td>
                                <td class="px-6 py-4 text-sm font-medium text-right whitespace-nowrap">
                                    <a wire:click="edit({{ $version->id }})" class="mr-1 btn btn-green">
                                        <i class="fa-solid fa-pen-to-square"></i>
                                    </a>

                                    <a class="btn btn-red" wire:click="confirmarEliminado({{ $version->id }})">
                                        <i class="fa-solid fa-trash-can"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                @if ($versions->hasPages())
                    <div class="px-6 py-8">
                        {{ $versions->links() }}
                    </div>
                @endif
            @else
                <div class="px-6 py-4">No hay ningún registro coincidente</div>
            @endif
        </x-table>
    </div>

    {{-- Modal editar --}}
    <x-dialog-modal wire:model="open_edit" maxWidth="md">
        <x-slot name="title">
            <div class="flex items-center space-x-2">
                <i class="fa-solid fa-pen-to-square text-green-500"></i>
                <span>Editar Versión</span>
            </div>
        </x-slot>

        <x-slot name="content">
            {{-- Marca --}}
            <div class="mb-4">
                <x-label value="Marca" />
                <select wire:model.live="brand_id"
                    class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500">
                    <option value="">-- Selecciona una marca --</option>
                    @foreach ($brands as $brand)
                        <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                    @endforeach
                </select>
                <x-input-error for="brand_id" />
            </div>

            {{-- Modelo dependiente --}}
            @if (!empty($modellos))
                <div class="mb-4" x-data x-transition.opacity.duration.400ms>
                    <x-label value="Modelo" />
                    <select wire:model.live="modello_id"
                        class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500">
                        <option value="">-- Selecciona un modelo --</option>
                        @foreach ($modellos as $modello)
                            <option value="{{ $modello->id }}">{{ $modello->name }}</option>
                        @endforeach
                    </select>
                    <x-input-error for="modello_id" />
                </div>
            @endif

            {{-- Versión --}}
            @if (!empty($modello_id))
                <div class="mb-4" x-data x-transition.opacity.duration.400ms>
                    <x-label value="Nombre de la versión" />
                    <x-input type="text" wire:model.live="name" placeholder="Ejemplo: ver2026"
                        class="w-full border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500" />
                    <x-input-error for="name" />
                </div>
            @endif
        </x-slot>

        <x-slot name="footer">
            <x-button wire:click="cancelar" class="mr-2">
                <i class="mx-2 fa-sharp fa-solid fa-xmark"></i> Cancelar
            </x-button>

            <x-danger-button wire:click="update" wire:loading.attr="disabled">
                <i class="mx-2 fa-regular fa-floppy-disk"></i> Actualizar
            </x-danger-button>
        </x-slot>
    </x-dialog-modal>


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
