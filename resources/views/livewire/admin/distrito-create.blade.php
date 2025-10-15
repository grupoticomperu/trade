<div>
    {{-- Botón NUEVO (estilo unificado con otros módulos) --}}
    <div class="flex items-center justify-center">
        <button class="items-center justify-center sm:flex btn btn-orange" wire:click="$set('open_create', true)">
            <i class="mx-2 fa-regular fa-file"></i> Nuevo
        </button>
    </div>

    {{-- Modal Crear --}}
    <x-dialog-modal wire:model="open_create" maxWidth="md">
        <x-slot name="title">
            <div class="flex items-center space-x-2">
                <i class="fa-solid fa-circle-plus text-blue-500"></i>
                <span>Registrar Nuevo Distrito</span>
            </div>
        </x-slot>

        <x-slot name="content">
            <div class="mb-4">
                <x-label value="Nombre del Distrito" />
                <x-input type="text" wire:model="name" class="w-full" />
                <x-input-error for="name" />
            </div>
        </x-slot>

        <x-slot name="footer">
            <x-button wire:click="$set('open_create', false)" class="mr-2">
                <i class="mx-2 fa-sharp fa-solid fa-xmark"></i> Cancelar
            </x-button>

            <x-danger-button wire:click="save" wire:loading.attr="disabled" class="disabled:opacity-25">
                <i class="mx-2 fa-regular fa-floppy-disk"></i> Guardar
            </x-danger-button>
        </x-slot>
    </x-dialog-modal>
</div>

