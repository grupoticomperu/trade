<div>
    <div class="flex items-center justify-center">
        <button class="items-center justify-center sm:flex btn btn-orange" wire:click="nuevo">
            <i class="mx-2 fa-regular fa-file"></i> Nuevo
        </button>
    </div>

    <x-dialog-modal wire:model="open">
        <x-slot name="title">Crear Nuevo Modelo</x-slot>

        <x-slot name="content">
            <div class="mb-4">
                <x-label value="Nombre del modelo" />
                <x-input type="text" class="w-full" wire:model="name" placeholder="Ejemplo: Corolla, Civic, Ranger..." />
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
            <x-button wire:click="$set('open', false)" class="mr-2">
                <i class="mx-2 fa-sharp fa-solid fa-xmark"></i> Cancelar
            </x-button>
            <x-danger-button wire:click="save" wire:loading.attr="disabled">
                <i class="mx-2 fa-regular fa-floppy-disk"></i> Guardar
            </x-danger-button>
        </x-slot>
    </x-dialog-modal>
</div>
