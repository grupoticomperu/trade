<div>
    @if ($open)
        <div class="fixed inset-0 z-40 bg-slate-900/60 backdrop-blur-[2px]"></div>
        <div class="fixed inset-0 z-50 flex items-center justify-center p-4">
            <div role="dialog" aria-modal="true"
                class="w-full max-w-3xl rounded-2xl bg-white shadow-2xl ring-1 ring-slate-900/10 border border-slate-100 overflow-hidden">
                <div class="h-1.5 w-full bg-emerald-500"></div>

                <div class="p-6">
                    <div class="flex items-center justify-between mb-4">
                        <h3 class="text-lg font-semibold">Generar documento de compra</h3>
                        <button wire:click="close"
                            class="px-3 py-1 rounded-lg border border-slate-200 text-slate-600 hover:bg-slate-50">
                            ✕
                        </button>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                        <div>
                            <x-label value="Oportunidad (CRM)" />
                            <div class="mt-1 px-3 py-2 rounded border bg-gray-50">
                                #{{ $crmId }}
                            </div>
                            @error('crmId')
                                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <x-label value="Fecha" />
                            <x-input type="date" class="mt-1 w-full" wire:model.defer="fecha" />
                            @error('fecha')
                                <x-input-error for="fecha" class="mt-1" />
                            @enderror
                        </div>

                        <div>
                            <x-label value="N° Comprobante (opcional)" />
                            <x-input type="text" class="mt-1 w-full" wire:model.defer="numcomprobante" />
                            @error('numcomprobante')
                                <x-input-error for="numcomprobante" class="mt-1" />
                            @enderror
                        </div>

                        <div>
                            <x-label value="Proveedor" />
                            <div class="mt-1 px-3 py-2 rounded border bg-gray-50">{{ $proveedorNombre }}</div>
                        </div>

                        <div>
                            <x-label value="Vehículo" />
                            <div class="mt-1 px-3 py-2 rounded border bg-gray-50">{{ $vehiculoNombre }}</div>
                        </div>

                        <div>
                            <x-label value="Precio" />
                            <x-input type="number" step="0.01" min="0" class="mt-1 w-full"
                                wire:model.defer="precio" />
                            @error('precio')
                                <x-input-error for="precio" class="mt-1" />
                            @enderror
                        </div>


                      


                        <div class="sm:col-span-2">
                            <x-label value="Observación (opcional)" />
                            <x-textarea rows="3" class="w-full mt-1" wire:model.defer="observacion"></x-textarea>
                            @error('observacion')
                                <x-input-error for="observacion" class="mt-1" />
                            @enderror
                        </div>
                    </div>

                    <div class="mt-6 flex justify-end gap-3">
                        <button wire:click="close" type="button"
                            class="px-4 py-2 rounded-lg border border-gray-300 text-gray-700 hover:bg-gray-50">
                            Cancelar
                        </button>
                        <x-danger-button wire:click="save" wire:loading.attr="disabled">
                            <span wire:loading.remove>Generar documento</span>
                            <span wire:loading>Generando…</span>
                        </x-danger-button>
                    </div>
                </div>
            </div>
        </div>
    @endif

</div>
