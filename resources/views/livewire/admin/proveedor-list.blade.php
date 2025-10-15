<div wire:lazy>
    <x-slot name="header">
        <div class="flex items-center">
            <h2 class="text-xl font-semibold leading-tight text-gray-600">Lista de Proveedores</h2>
        </div>
    </x-slot>

    <div class="container py-12 mx-auto border-gray-400 max-w-7xl sm:px-6 lg:px-8">
        <x-table>
            {{-- 🔍 Filtros --}}
            <div class="items-center px-6 py-4 bg-gray-200 sm:flex">
                <div class="flex items-center justify-center mb-2 md:mb-0">
                    <span>Mostrar </span>
                    <select wire:model="cant"
                        class="block p-7 py-2.5 ml-3 mr-3 text-sm text-gray-900 border border-gray-300 rounded-lg">
                        <option value="10">10</option>
                        <option value="25">25</option>
                        <option value="50">50</option>
                    </select>
                    <span class="mr-3">registros</span>
                </div>

                <div class="flex items-center justify-center mb-2 mr-4 md:mb-0 sm:w-full">
                    <x-input type="text" wire:model.live="search"
                        class="flex items-center justify-center w-80 sm:w-full rounded-lg py-2.5"
                        placeholder="Buscar proveedor..." />
                </div>

                @livewire('admin.proveedor-create')
            </div>

            {{-- 🧾 Tabla --}}
            @if (count($proveedors))
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            {{-- Orden con íconos --}}
                            @foreach ([
        'nombre' => 'Nombre',
        'telefono' => 'Teléfono',
        'correo' => 'Correo',
        'distrito_name' => 'Distrito',
    ] as $col => $label)
                                <th scope="col"
                                    class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-600 uppercase cursor-pointer"
                                    wire:click="order('{{ $col }}')">
                                    {{ $label }}
                                    @if ($sort === $col)
                                        @if ($direction === 'asc')
                                            <i class="float-right mt-1 fas fa-sort-alpha-up-alt"></i>
                                        @else
                                            <i class="float-right mt-1 fas fa-sort-alpha-down-alt"></i>
                                        @endif
                                    @else
                                        <i class="float-right mt-1 fas fa-sort text-gray-400"></i>
                                    @endif
                                </th>
                            @endforeach

                            <th
                                class="px-6 py-3 text-xs font-medium tracking-wider text-center text-gray-600 uppercase">
                                Estado</th>
                            <th class="px-6 py-3 text-xs font-medium tracking-wider text-right text-gray-600 uppercase">
                                Acciones</th>
                        </tr>
                    </thead>

                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach ($proveedors as $prov)
                            <tr>
                                <td class="px-6 py-3">{{ $prov->nombre }}</td>
                                <td class="px-6 py-3">{{ $prov->telefono }}</td>
                                <td class="px-6 py-3">{{ $prov->correo }}</td>
                                <td class="px-6 py-3">{{ $prov->distrito->name ?? '—' }}</td>
                                <td class="px-6 py-3 text-center">
                                    <span
                                        class="px-2 py-1 text-xs font-semibold rounded-full {{ $prov->estado == 'activo' ? 'text-green-700 bg-green-100' : 'text-red-700 bg-red-100' }}">
                                        {{ ucfirst($prov->estado) }}
                                    </span>
                                </td>
                                <td class="px-6 py-3 text-right">
                                    <a wire:click="edit({{ $prov->id }})" class="btn btn-green mr-1"
                                        title="Editar"><i class="fa-solid fa-pen-to-square"></i></a>

                                    <a class="btn btn-red" wire:click="confirmarEliminado({{ $prov->id }})"
                                        title="Eliminar">
                                        <i class="fa-solid fa-trash-can"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                @if ($proveedors->hasPages())
                    <div class="px-6 py-8">{{ $proveedors->links() }}</div>
                @endif
            @else
                <div class="px-6 py-4 text-center">No hay registros coincidentes.</div>
            @endif
        </x-table>
    </div>

    
    {{-- 🧩 Modal edición con formato igual al de crear --}}
    <x-dialog-modal wire:model="open_edit" maxWidth="2xl">
        <x-slot name="title">
            <div class="flex items-center space-x-2">
                <i class="fa-solid fa-user-pen text-blue-500"></i>
                <span>Editar Proveedor</span>
            </div>
        </x-slot>

        <x-slot name="content">
            <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                {{-- Nombre --}}
                <div>
                    <x-label value="Nombre" />
                    <x-input type="text" wire:model="nombre" class="w-full" />
                    <x-input-error for="nombre" />
                </div>

                {{-- Teléfono --}}
                <div>
                    <x-label value="Teléfono" />
                    <x-input type="text" wire:model="telefono" class="w-full" />
                    <x-input-error for="telefono" />
                </div>

                {{-- Correo --}}
                <div>
                    <x-label value="Correo" />
                    <x-input type="email" wire:model="correo" class="w-full" />
                    <x-input-error for="correo" />
                </div>

                {{-- DNI --}}
                <div>
                    <x-label value="DNI" />
                    <x-input type="text" wire:model="dni" class="w-full" />
                    <x-input-error for="dni" />
                </div>

                {{-- Dirección --}}
                <div class="col-span-2">
                    <x-label value="Dirección" />
                    <x-input type="text" wire:model="direccion" class="w-full" />
                    <x-input-error for="direccion" />
                </div>

                {{-- Distrito --}}
                <div>
                    <x-label value="Distrito" />
                    <select wire:model="distrito_id"
                        class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500">
                        <option value="">-- Selecciona un distrito --</option>
                        @foreach ($distritos as $d)
                            <option value="{{ $d->id }}">{{ $d->name }}</option>
                        @endforeach
                    </select>
                    <x-input-error for="distrito_id" />
                </div>

                {{-- Estado --}}
                <div>
                    <x-label value="Estado" />
                    <select wire:model="estado"
                        class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500">
                        <option value="activo">Activo</option>
                        <option value="inactivo">Inactivo</option>
                    </select>
                    <x-input-error for="estado" />
                </div>

                {{-- Observación --}}
                <div class="col-span-2">
                    <x-label value="Observación" />
                    <textarea wire:model="observacion" rows="2"
                        class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500"></textarea>
                    <x-input-error for="observacion" />
                </div>
            </div>
        </x-slot>

        <x-slot name="footer">
            <x-button wire:click="cancelar" class="mr-2">
                <i class="mx-2 fa-sharp fa-solid fa-xmark"></i> Cancelar
            </x-button>

            <x-danger-button wire:click="update" wire:loading.attr="disabled" class="disabled:opacity-25">
                <i class="mx-2 fa-regular fa-floppy-disk"></i> Actualizar
            </x-danger-button>
        </x-slot>
    </x-dialog-modal>


    @push('scripts')
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
                        Livewire.dispatch("eliminar");
                    }
                });
            });
        </script>
    @endpush
</div>
