<div class="bg-white p-4 rounded-xl shadow-sm space-y-4">
    <h4 class="font-semibold text-gray-800">Color del vehículo</h4>

    {{-- Select de colores existentes --}}
    <div>
        <x-label value="Seleccionar color existente" />
        <select wire:model="color_id" class="w-full border-gray-300 rounded-md">
            <option value="">-- Seleccione un color --</option>
            @foreach ($colors as $color)
                <option value="{{ $color->id }}">{{ $color->name }}</option>
            @endforeach
        </select>
        <x-input-error for="color_id" />
    </div>

    {{-- Campo para agregar nuevo color --}}
    <div>
        <x-label value="Agregar nuevo color (si no existe)" />
        <x-input type="text" wire:model.defer="nuevo_color" placeholder="Ej: Azul perlado" class="w-full" />
        <x-input-error for="nuevo_color" />
    </div>

    {{-- Botón para guardar --}}
    <div class="text-right">
        <x-danger-button wire:click="save">
            <i class="fa-regular fa-floppy-disk mr-2"></i> Guardar Color
        </x-danger-button>
    </div>
</div>