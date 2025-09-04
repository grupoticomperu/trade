<div wire:init="loadCrms">
    <x-slot name="header">
        <div class="bg-gray-100 p-2 rounded-lg shadow">
            <div class="flex items-center justify-between">
                <div class="flex items-center gap-3">
                    <i class="fa-solid fa-badge-check text-emerald-600 text-xl"></i>
                    <h1 class="text-2xl font-semibold text-gray-800">Oportunidades Ganadas</h1>
                </div>
            </div>
        </div>
    </x-slot>

    <div class="container py-2 mx-auto max-w-7xl sm:px-6 lg:px-8">
        <div class="items-center px-6 py-2 bg-gray-200 sm:flex">
            <div class="flex items-center justify-center mb-2 md:mb-0">
                <span>Mostrar </span>
                <select wire:model.live="cant" class="ml-3 mr-3 py-2.5 text-sm border rounded-lg">
                    <option value="10"> 10 </option>
                    <option value="25">25</option>
                    <option value="50">50</option>
                    <option value="100">100</option>
                </select>
                <span class="mr-3">registros</span>
            </div>

            <div class="flex items-center justify-center mb-2 md:mb-0 sm:w-full">
                <x-input type="text" wire:model.live="search" class="w-80 sm:w-full rounded-lg py-2.5"
                    placeholder="buscar proveedor, producto, nombre..." />
            </div>
        </div>
    </div>

    <div class="container mx-auto py-0 max-w-7xl sm:px-6 lg:px-8">
        <x-table>
            @if (!empty($crms) && count($crms))
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">ID</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Proveedor</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Oportunidad</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Vehículo</th>
                            <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase">Acciones</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach ($crms as $crm)
                            <tr>
                                <td class="px-6 py-3 text-sm text-gray-700">{{ $crm->id }}</td>
                                <td class="px-6 py-3 text-sm text-gray-700">{{ $crm->proveedor->nombre ?? '—' }}</td>
                                <td class="px-6 py-3 text-sm text-gray-700">{{ $crm->nombre }}</td>
                                <td class="px-6 py-3 text-sm text-gray-700">{{ $crm->producto->nombre ?? '—' }}</td>
                                <td class="px-6 py-3 text-sm text-right">

                                    @if ($crm->compra)
                                        <span
                                            class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-emerald-50 text-emerald-700 border border-emerald-200">
                                            <i class="fa-solid fa-file-circle-check"></i>
                                            Emitido #{{ $crm->compra->id }}
                                        </span>
                                    @else
                                        <button type="button"
                                            class="inline-flex items-center gap-2 px-3 py-2 rounded-lg bg-indigo-600 text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 disabled:opacity-50"
                                            wire:click="abrirModalCompra({{ $crm->id }})"
                                            wire:loading.attr="disabled" wire:target="abrirModalCompra">
                                            <i class="fa-solid fa-file-invoice-dollar"></i>
                                            <span>Compra</span>
                                        </button>
                                    @endif



                                    {{-- <button type="button"
                                        class="inline-flex items-center gap-2 px-3 py-2 rounded-lg bg-indigo-600 text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500"
                                        wire:click="abrirModalCompra({{ $crm->id }})">
                                        <i class="fa-solid fa-file-invoice-dollar"></i>
                                        <span>Compra</span>
                                    </button> --}}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <div class="px-6 py-8 text-center text-gray-500">No hay ganados.</div>
            @endif
        </x-table>
    </div>

    {{-- Modal para crear el documento desde CRM --}}
    <livewire:admin.compras.create-from-crm-modal />
</div>
