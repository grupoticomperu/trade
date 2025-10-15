<div>
    <div class="flex items-center justify-center">
        <button class="items-center justify-center sm:flex btn btn-orange" wire:click="nuevo">
            <i class="mx-2 fa-regular fa-file"></i> Nueva Versión
        </button>
    </div>

    <x-dialog-modal wire:model="open" maxWidth="md">
        <x-slot name="title">
            <div class="flex items-center space-x-2">
                <i class="fa-solid fa-layer-group text-blue-500"></i>
                <span>Registrar Nueva Versión</span>
            </div>
        </x-slot>

        <x-slot name="content">
            {{-- 🔹 Seleccionar Marca --}}
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

            {{-- 🔹 Seleccionar Modelo (aparece después de elegir marca) --}}
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

            {{-- 🔹 Campo para escribir versión (solo aparece si ya hay modelo seleccionado) --}}
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
            <x-button wire:click="$set('open', false)" class="mr-2">
                <i class="mx-2 fa-sharp fa-solid fa-xmark"></i> Cancelar
            </x-button>

            <x-danger-button wire:click="save" wire:loading.attr="disabled" class="disabled:opacity-25">
                <i class="mx-2 fa-regular fa-floppy-disk"></i> Guardar
            </x-danger-button>
        </x-slot>
    </x-dialog-modal>
</div>
