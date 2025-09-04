<div wire:init="loadCompras">
    <x-slot name="header">
        <div class="bg-gray-100 p-2 rounded-lg shadow">
            <div class="flex items-center justify-between">
                <div class="flex items-center gap-3">
                    <i class="fa-solid fa-file-invoice-dollar text-indigo-600 text-xl"></i>
                    <h1 class="text-2xl font-semibold text-gray-800">Compras</h1>
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
                         placeholder="buscar comprobante, proveedor, producto, usuario, observación..." />
            </div>
        </div>
    </div>

    <div class="container mx-auto py-0 max-w-7xl sm:px-6 lg:px-8">
        <x-table>
            @if (!empty($compras) && count($compras))
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">ID</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">N° Comp.</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Fecha</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Proveedor</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Vehículo</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Usuario</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Precio</th>
                            <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase">Acciones</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach ($compras as $cmp)
                            <tr>
                                <td class="px-6 py-3 text-sm text-gray-700">{{ $cmp->id }}</td>
                                <td class="px-6 py-3 text-sm text-gray-700">{{ $cmp->numcomprobante ?? '—' }}</td>
                                <td class="px-6 py-3 text-sm text-gray-700">
                                    {{ optional($cmp->fecha)->format('d/m/Y') }}
                                </td>
                                <td class="px-6 py-3 text-sm text-gray-700">{{ $cmp->proveedor->nombre ?? '—' }}</td>
                                <td class="px-6 py-3 text-sm text-gray-700">{{ $cmp->producto->nombre ?? '—' }}</td>
                                <td class="px-6 py-3 text-sm text-gray-700">{{ $cmp->user->name ?? '—' }}</td>
                                <td class="px-6 py-3 text-sm text-gray-700">
                                    {{ is_null($cmp->precio) ? '—' : number_format($cmp->precio, 2) }}
                                </td>
                                <td class="px-6 py-3 text-sm text-right">
                                    <button type="button"
                                            class="inline-flex items-center gap-2 px-3 py-2 rounded-lg bg-slate-700 text-white hover:bg-slate-800 focus:outline-none focus:ring-2 focus:ring-slate-500"
                                            wire:click="abrirModalDetalle({{ $cmp->id }})"
                                            wire:loading.attr="disabled"
                                            wire:target="abrirModalDetalle">
                                        <i class="fa-solid fa-eye"></i>
                                        <span>Ver</span>
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <div class="px-6 py-4">
                    {{ $compras->links() }}
                </div>
            @else
                @if ($readyToLoad)
                    <div class="px-6 py-8 text-center text-gray-500">No hay compras.</div>
                @else
                    <div class="px-6 py-8 text-center text-gray-500">Cargando, espere un momento…</div>
                @endif
            @endif
        </x-table>
    </div>

    {{-- Modal de detalle --}}
    <livewire:admin.compras.show-modal />
</div>
