<div class="max-w-6xl mx-auto mt-6 bg-white rounded-xl shadow p-6">
    <h3 class="text-lg font-bold mb-6 underline underline-offset-4 text-gray-700">Registrar nuevo Lead</h3>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
        <div>
            <x-label value="Fecha de derivación" />
            <x-input type="date" wire:model="fechaderivacion" class="w-full" />
            <x-input-error for="fechaderivacion" />
        </div>

        <div>
            <x-label value="Fecha" />
            <x-input type="date" wire:model="fecha" class="w-full" />
            <x-input-error for="fecha" />
        </div>

        <div>
            <x-label value="Nombres" />
            <x-input type="text" wire:model="nombres" placeholder="Nombre completo" class="w-full" />
            <x-input-error for="nombres" />
        </div>

        <div>
            <x-label value="Teléfono" />
            <x-input type="text" wire:model="telefono" placeholder="Número de contacto" class="w-full" />
            <x-input-error for="telefono" />
        </div>

        <div>
            <x-label value="Correo Electrónico" />
            <x-input type="email" wire:model="correoelectronico" placeholder="correo@ejemplo.com" class="w-full" />
            <x-input-error for="correoelectronico" />
        </div>

        <div>
            <x-label value="Marca" />
            <select wire:model.live="brand_id" class="w-full border-gray-300 rounded-md">
                <option value="">-- Seleccione --</option>
                @foreach ($brands as $brand)
                    <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                @endforeach
            </select>
            <x-input-error for="brand_id" />
        </div>


        <div>
            <x-label value="Modelo" />
            <select wire:model.live="modello_id" class="w-full border-gray-300 rounded-md">
                <option value="">-- Seleccione --</option>
                @foreach ($modellos as $modello)
                    <option value="{{ $modello->id }}">{{ $modello->name }}</option>
                @endforeach
            </select>
            <x-input-error for="modello_id" />
        </div>


        {{-- @if (!empty($modellos))
            <div>
                <x-label value="Modelo" />
                <select wire:model.live="modello_id" class="w-full border-gray-300 rounded-md">
                    <option value="">-- Seleccione --</option>
                    @foreach ($modellos as $modello)
                        <option value="{{ $modello->id }}">{{ $modello->name }}</option>
                    @endforeach
                </select>
                <x-input-error for="modello_id" />
            </div>
        @endif --}}

        {{-- <div>
            <x-label value="Modelo" />
            <select wire:model="modello_id" class="w-full border-gray-300 rounded-md">
                <option value="">-- Seleccione --</option>
                @foreach ($modellos as $modello)
                    <option value="{{ $modello->id }}">{{ $modello->name }}</option>
                @endforeach
            </select>
            <x-input-error for="modello_id" />
        </div> --}}

        <div>
            <x-label value="Versión" />
            <select wire:model.live="version_id" class="w-full border-gray-300 rounded-md">
                <option value="">-- Seleccione --</option>
                @foreach ($versions as $version)
                    <option value="{{ $version->id }}">{{ $version->name }}</option>
                @endforeach
            </select>
            <x-input-error for="version_id" />
        </div>



        {{--       @if (!empty($versions))
            <div>
                <x-label value="Versión" />
                <select wire:model.live="version_id" class="w-full border-gray-300 rounded-md">
                    <option value="">-- Seleccione --</option>
                    @foreach ($versions as $version)
                        <option value="{{ $version->id }}">{{ $version->name }}</option>
                    @endforeach
                </select>
                <x-input-error for="version_id" />
            </div>
        @endif --}}

        <div>
            <x-label value="Año" />
            <x-input type="text" wire:model="anio" class="w-full" />
            <x-input-error for="anio" />
        </div>

        <div>
            <x-label value="Kilometraje" />
            <x-input type="text" wire:model="kilometraje" class="w-full" />
            <x-input-error for="kilometraje" />
        </div>

        <div>
            <x-label value="Placa" />
            <x-input type="text" wire:model="placa" class="w-full" />
            <x-input-error for="placa" />
        </div>

        <div>
            <x-label value="Usuario Responsable" />
            <select wire:model="user_id" class="w-full border-gray-300 rounded-md">
                <option value="">-- Seleccione --</option>
                @foreach ($users as $user)
                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                @endforeach
            </select>
            <x-input-error for="user_id" />
        </div>

        <div>
            <x-label value="Tipo de Marketing" />
            <select wire:model="tipomarketing_id" class="w-full border-gray-300 rounded-md">
                <option value="">-- Seleccione --</option>
                @foreach ($tipomarketings as $tipo)
                    <option value="{{ $tipo->id }}">{{ $tipo->name }}</option>
                @endforeach
            </select>
            <x-input-error for="tipomarketing_id" />
        </div>

        <div>
            <x-label value="Observaciones" />
            <x-textarea wire:model="observacion" class="w-full"></x-textarea>
        </div>
    </div>

    <div class="mt-8 text-right">
        <x-danger-button wire:click="save">
            <i class="fa-regular fa-floppy-disk mr-2"></i> Crear Lead
        </x-danger-button>
    </div>
</div>
