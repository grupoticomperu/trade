<div>
    <div class="flex items-center justify-center">
        <button class="items-center justify-center sm:flex btn btn-orange" wire:click="nuevo">
            <i class="mx-2 fa-regular fa-file"></i> Nuevo
        </button>
    </div>

    <x-dialog-modal wire:model="open">
        <x-slot name="title">Crear Nueva Etapa</x-slot>

        <x-slot name="content">
            <div class="mb-4">
                <x-label value="Nombre" />
                <x-input type="text" class="w-full" wire:model="name" placeholder="Ejemplo: Contactado, En proceso..." />
                <x-input-error for="name" />
            </div>

            <div class="mb-4">
                <x-label value="Orden" />
                <x-input type="number" class="w-full" wire:model="order" placeholder="Ejemplo: 1, 2, 3..." />
                <x-input-error for="order" />
            </div>
        </x-slot>

        <x-slot name="footer">
            <x-button wire:click="$set('open', false)" class="mr-2">
                <i class="mx-2 fa-sharp fa-solid fa-xmark"></i>Cancelar
            </x-button>

            <x-danger-button wire:click="save" wire:loading.attr="disabled" class="disabled:opacity-25">
                <i class="mx-2 fa-regular fa-floppy-disk"></i> Guardar
            </x-danger-button>
        </x-slot>
    </x-dialog-modal>
</div>
