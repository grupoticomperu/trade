<div>
   @if ($open)
    <div class="fixed inset-0 z-40 bg-slate-900/60 backdrop-blur-[2px]"></div>
    <div class="fixed inset-0 z-50 flex items-center justify-center p-4">
        <div role="dialog" aria-modal="true"
             class="w-full max-w-3xl rounded-2xl bg-white shadow-2xl ring-1 ring-slate-900/10 border border-slate-100 overflow-hidden">
            <div class="h-1.5 w-full bg-indigo-500"></div>

            <div class="p-6">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-lg font-semibold">
                        Detalle de Compra #{{ $compraId }}
                    </h3>
                    <button wire:click="close"
                            class="px-3 py-1 rounded-lg border border-slate-200 text-slate-600 hover:bg-slate-50">
                        ✕
                    </button>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                    <div>
                        <x-label value="N° Comprobante"/>
                        <div class="mt-1 px-3 py-2 rounded border bg-gray-50">{{ $numcomprobante ?? '—' }}</div>
                    </div>

                    <div>
                        <x-label value="Fecha"/>
                        <div class="mt-1 px-3 py-2 rounded border bg-gray-50">
                            {{ $fecha ? \Carbon\Carbon::parse($fecha)->format('d/m/Y') : '—' }}
                        </div>
                    </div>

                    <div>
                        <x-label value="Proveedor"/>
                        <div class="mt-1 px-3 py-2 rounded border bg-gray-50">{{ $proveedorNombre }}</div>
                    </div>

                    <div>
                        <x-label value="Vehículo"/>
                        <div class="mt-1 px-3 py-2 rounded border bg-gray-50">{{ $vehiculoNombre }}</div>
                    </div>

                    <div>
                        <x-label value="Usuario"/>
                        <div class="mt-1 px-3 py-2 rounded border bg-gray-50">{{ $usuarioNombre }}</div>
                    </div>

                    <div>
                        <x-label value="Etapa"/>
                        <div class="mt-1 px-3 py-2 rounded border bg-gray-50">{{ $etapaNombre }}</div>
                    </div>

                    <div>
                        <x-label value="Precio"/>
                        <div class="mt-1 px-3 py-2 rounded border bg-gray-50">
                            {{ is_null($precio) ? '—' : number_format($precio, 2) }}
                        </div>
                    </div>

                    <div>
                        <x-label value="CRM"/>
                        <div class="mt-1 px-3 py-2 rounded border bg-gray-50">
                            {{ $crmNombre }} ({{ $crmId ? "#$crmId" : '—' }})
                        </div>
                    </div>

                    <div class="sm:col-span-2">
                        <x-label value="Observación"/>
                        <div class="mt-1 px-3 py-2 rounded border bg-gray-50 whitespace-pre-line">
                            {{ $observacion ?? '—' }}
                        </div>
                    </div>
                </div>

                <div class="mt-6 flex justify-end gap-3">
                    {{-- (Opcional) Botón de impresión / PDF --}}
                    {{-- <a href="{{ route('admin.compras.show', $compraId) }}" class="px-4 py-2 rounded-lg border">Imprimir</a> --}}
                    <button wire:click="close" type="button"
                            class="px-4 py-2 rounded-lg border border-gray-300 text-gray-700 hover:bg-gray-50">
                        Cerrar
                    </button>
                </div>
            </div>
        </div>
    </div>
@endif

</div>
