<div>
    <x-slot name="header">
        <div class="bg-gray-100 p-2 rounded-lg shadow">
            <div class="flex items-center justify-between">
                <div class="flex items-center gap-3">
                    <i class="fa-solid fa-badge-check text-emerald-600 text-xl"></i>
                    <h1 class="text-2xl font-semibold text-gray-800">Leads </h1>
                </div>
            </div>
        </div>
    </x-slot>
    <div class="max-w-6xl mx-auto mt-6 bg-white rounded-xl shadow p-6">


        <h2 class="text-2xl font-bold mb-6">Editar Lead</h2>


        {{-- ✅ Fila 0: Fechas --}}
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
            <div>
                <label class="font-semibold text-gray-700">Fecha de derivación</label>
                <input type="date" wire:model="fechaderivacion" class="w-full border rounded p-2">
            </div>

            <div>
                <label class="font-semibold text-gray-700">Fecha</label>
                <input type="date" wire:model="fecha" class="w-full border rounded p-2">
            </div>
        </div>


        {{-- ✅ Fila 1: Nombres / Teléfono / Correo --}}
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
            <div>
                <label class="font-semibold text-gray-700">Nombres</label>
                <input type="text" wire:model="nombres" class="w-full border rounded p-2">
            </div>

            <div>
                <label class="font-semibold text-gray-700">Teléfono</label>
                <input type="text" wire:model="telefono" class="w-full border rounded p-2">
            </div>

            <div>
                <label class="font-semibold text-gray-700">Correo electrónico</label>
                <input type="email" wire:model="correoelectronico" class="w-full border rounded p-2">
            </div>
        </div>

        {{-- ✅ Fila 2: Kilometraje / Placa / Año --}}
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
            <div>
                <label class="font-semibold text-gray-700">Kilometraje</label>
                <input type="text" wire:model="kilometraje" class="w-full border rounded p-2">
            </div>

            <div>
                <label class="font-semibold text-gray-700">Placa</label>
                <input type="text" wire:model="placa" class="w-full border rounded p-2">
            </div>

            <div>
                <label class="font-semibold text-gray-700">Año <span
                        class="italic text-red-600">{{ $lead->anio ?? '—' }}</span></label>

                <select wire:model="yearId" class="w-full border rounded p-2">
                    <option value="">Seleccione año</option>
                    @foreach ($years as $year)
                        <option value="{{ $year->id }}">{{ $year->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        {{-- ✅ Fila 3: Marca / Modelo / Versión --}}
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
            {{-- Marca --}}
            <div>
                <label class="font-semibold text-gray-700">Marca ingresada <span
                        class="italic text-red-600">{{ $lead->marca ?? '—' }}</span></label>

                <select wire:model.live="brandId" class="w-full border rounded p-2">
                    <option value="">Seleccione marca</option>
                    @foreach ($brands as $brand)
                        <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                    @endforeach
                </select>
            </div>

            {{-- Modelo --}}
            <div>
                <label class="font-semibold text-gray-700">Modelo ingresado <span
                        class="italic text-red-600">{{ $lead->modelo ?? '—' }}</span></label>

                <select wire:model.live="modelloId" class="w-full border rounded p-2" @disabled(empty($brandId))>
                    <option value="">Seleccione modelo</option>
                    @foreach ($modellos as $mod)
                        <option value="{{ $mod->id }}">{{ $mod->name }}</option>
                    @endforeach
                </select>
            </div>

            {{-- Versión --}}
            <div>
                <label class="font-semibold text-gray-700">Versión</label>
                <select wire:model.live="versionId" class="w-full border rounded p-2" @disabled(empty($modelloId))>
                    <option value="">Seleccione versión</option>
                    @foreach ($versions as $ver)
                        <option value="{{ $ver->id }}">{{ $ver->name }}</option>
                    @endforeach
                </select>
            </div>


            <div>
                <label class="font-semibold text-gray-700">Usuario</label>
                <select wire:model.live="userId" class="w-full border rounded p-2" >
                    <option value="">Seleccione usuario</option>
                    @foreach ($users as $user)
                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                    @endforeach
                </select>
            </div>

        </div>

        {{-- ✅ Fila 4: Observación --}}
        <div class="mb-6">
            <label class="font-semibold text-gray-700">Observación</label>
            <textarea wire:model="observacion" class="w-full border rounded p-2" rows="3"
                placeholder="Escribe tus observaciones aquí..."></textarea>
        </div>

        {{-- Botón guardar --}}
        <button wire:click="save"
            class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-6 py-2 rounded transition">
            Guardar Cambios
        </button>

        {{-- Mensaje de éxito --}}
        @if (session()->has('message'))
            <div class="mt-4 text-green-600 font-semibold">{{ session('message') }}</div>
        @endif
    </div>
</div>
