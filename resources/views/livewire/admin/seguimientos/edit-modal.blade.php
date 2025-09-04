<div>
    

@if ($open)
    {{-- BACKDROP con blur y oscurecimiento --}}
    <div class="fixed inset-0 z-40 bg-slate-900/60 backdrop-blur-[2px]"></div>

    {{-- CONTENEDOR del modal --}}
    <div class="fixed inset-0 z-50 flex items-center justify-center p-4">
        <div role="dialog" aria-modal="true"
             class="w-full max-w-3xl rounded-2xl bg-white shadow-2xl ring-1 ring-slate-900/10 border border-slate-100 overflow-hidden">

            {{-- BARRA SUPERIOR de acento (puedes cambiar a bg-blue-600 para tu paleta) --}}
            <div class="h-1.5 w-full bg-indigo-500"></div>

            <div class="p-6">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-lg font-semibold">Editar seguimiento #{{ $seguimientoId }}</h3>

                    <button wire:click="close"
                            class="px-3 py-1 rounded-lg border border-slate-200 text-slate-600 hover:bg-slate-50 hover:text-slate-900 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                        ✕
                    </button>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                    {{-- Nombre / descripción --}}
                    <div class="sm:col-span-2 lg:col-span-3">
                        <x-label for="nombre" value="Nombre / Descripción" />
                        <x-textarea id="nombre" rows="4" class="w-full"
                                    wire:model.defer="nombre"></x-textarea>
                        <x-input-error for="nombre" class="mt-1" />
                    </div>

                    {{-- CRM relacionado (opcional) --}}
                    <div>
                        <x-label for="crmId" value="CRM relacionado" />
                        <select id="crmId" class="mt-1 w-full rounded-md border-gray-300"
                                wire:model.defer="crmId">
                            <option value="">— Sin CRM —</option>
                            @foreach($crms as $c)
                                <option value="{{ $c->id }}">{{ $c->nombre ?? ('CRM #'.$c->id) }}</option>
                            @endforeach
                        </select>
                        <x-input-error for="crmId" class="mt-1" />
                    </div>

                    {{-- Fecha --}}
                    <div>
                        <x-label for="fecha" value="Fecha" />
                        <x-input id="fecha" type="date" class="mt-1 w-full"
                                 wire:model.defer="fecha" />
                        <x-input-error for="fecha" class="mt-1" />
                    </div>
                </div>

                <div class="mt-6 flex justify-end gap-3">
                    <button wire:click="close" type="button"
                            class="px-4 py-2 rounded-lg border border-gray-300 text-gray-700 hover:bg-gray-50">
                        Cancelar
                    </button>

                    <x-danger-button wire:click="save" wire:loading.attr="disabled">
                        <span wire:loading.remove>Guardar cambios</span>
                        <span wire:loading>Guardando...</span>
                    </x-danger-button>
                </div>
            </div>
        </div>
    </div>
@endif




</div>
