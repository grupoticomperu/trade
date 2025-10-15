<div>
    <div class="flex items-center justify-center">
        <button class="items-center justify-center sm:flex btn btn-orange" wire:click="nuevo">
            <i class="mx-2 fa-regular fa-file"></i> Nuevo Proveedor
        </button>
    </div>
    
    <x-dialog-modal wire:model="open" maxWidth="2xl">
        <x-slot name="title">
            <div class="flex items-center space-x-2">
                <i class="fa-solid fa-user-tie text-blue-500"></i>
                <span>Registrar Nuevo Proveedor</span>
            </div>
        </x-slot>

        <x-slot name="content">
            <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                <div>
                    <x-label value="Nombre" />
                    <x-input type="text" wire:model="nombre" class="w-full" />
                    <x-input-error for="nombre" />
                </div>

                <div>
                    <x-label value="Teléfono" />
                    <x-input type="text" wire:model="telefono" class="w-full" />
                    <x-input-error for="telefono" />
                </div>

                <div>
                    <x-label value="Correo" />
                    <x-input type="email" wire:model="correo" class="w-full" />
                    <x-input-error for="correo" />
                </div>

                <div>
                    <x-label value="DNI" />
                    <x-input type="text" wire:model="dni" class="w-full" />
                    <x-input-error for="dni" />
                </div>

                <div class="col-span-2">
                    <x-label value="Dirección" />
                    <x-input type="text" wire:model="direccion" class="w-full" />
                    <x-input-error for="direccion" />
                </div>

                <div>
                    <x-label value="Distrito" />
                    <select wire:model="distrito_id"
                        class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500">
                        <option value="">-- Selecciona un distrito --</option>
                        @foreach ($distritos as $distrito)
                            <option value="{{ $distrito->id }}">{{ $distrito->name }}</option>
                        @endforeach
                    </select>
                    <x-input-error for="distrito_id" />
                </div>

                <div>
                    <x-label value="Estado" />
                    <select wire:model="estado"
                        class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500">
                        <option value="activo">Activo</option>
                        <option value="inactivo">Inactivo</option>
                    </select>
                </div>

                <div class="col-span-2">
                    <x-label value="Observación" />
                    <textarea wire:model="observacion"
                        class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500"
                        rows="2"></textarea>
                    <x-input-error for="observacion" />
                </div>
            </div>
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
