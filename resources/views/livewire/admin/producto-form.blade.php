<div class="grid grid-cols-1 md:grid-cols-3 gap-6">
    {{-- Marca --}}
    <div>
        <x-label value="Marca" />
        <select wire:model.live="brandId" name="brandId" class="w-full border-gray-300 rounded-md">
            <option value="">-- Seleccione --</option>
            @foreach ($brands as $brand)
                <option value="{{ $brand->id }}">{{ $brand->name }}</option>
            @endforeach
        </select>
        <x-input-error for="brandId" />
    </div>

    {{-- Modelo --}}
    <div>
        <x-label value="Modelo" />
        <select wire:model.live="modelloId" name="modelloId" class="w-full border-gray-300 rounded-md"
            @disabled(!$brandId)>
            <option value="">-- Seleccione --</option>
            @foreach ($modellos as $mod)
                <option value="{{ $mod->id }}">{{ $mod->name }}</option>
            @endforeach
        </select>
        <x-input-error for="modelloId" />
    </div>

    {{-- Versión --}}
    <div>
        <x-label value="Versión" />
        <select wire:model.live="versionId" name="versionId" class="w-full border-gray-300 rounded-md"
            @disabled(!$modelloId)>
            <option value="">-- Seleccione --</option>
            @foreach ($versions as $ver)
                <option value="{{ $ver->id }}">{{ $ver->name }}</option>
            @endforeach
        </select>
        <x-input-error for="versionId" />
    </div>



    {{-- 👇 Inputs hidden para que lleguen al Request del controller --}}
    <input type="hidden" name="brand_id" value="{{ $brandId }}">
    <input type="hidden" name="modello_id" value="{{ $modelloId }}">
    <input type="hidden" name="version_id" value="{{ $versionId }}">



</div>
