<div>
    <div class="flex items-center justify-center">
        <button class="items-center justify-center sm:flex btn btn-orange" wire:click="nuevo">
            <i class="mx-2 fa-regular fa-file"></i> Nuevo
        </button>
    </div>

    <x-dialog-modal wire:model="open">
        <x-slot name="title">
            Crear nuevo año
        </x-slot>

        <x-slot name="content">
            <div class="mb-4">
                <x-label value="Año" />
                <x-input type="text" class="w-full" wire:model="name" placeholder="Ejemplo: 2025" />
                <x-input-error for="name" />
            </div>
        </x-slot>

        <x-slot name="footer">
            <x-button wire:click="$set('open', false)" class="mr-2">
                <i class="mx-2 fa-sharp fa-solid fa-xmark"></i> Cancelar
            </x-button>

            <x-danger-button wire:click="save" wire:loading.attr="disabled" wire:target="save"
                class="disabled:opacity-25">
                <i class="mx-2 fa-regular fa-floppy-disk"></i> Guardar
            </x-danger-button>
        </x-slot>
    </x-dialog-modal>

    @push('scripts')
        <script>
            window.addEventListener('swal:success', event => {
                Swal.fire({
                    icon: 'success',
                    title: event.detail.title,
                    text: event.detail.text,
                    confirmButtonColor: '#3085d6'
                });
            });
        </script>
    @endpush
</div>

