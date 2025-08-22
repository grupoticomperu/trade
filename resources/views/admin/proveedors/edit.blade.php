<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800 flex items-center space-x-2">
            <a href="{{ route('admin.proveedors.index') }}" class="text-blue-600 no-underline flex items-center space-x-1">
                <i class="fas fa-users"></i>
                <span>{{ __('List Proveedores') }}</span>
            </a>
            <span class="text-gray-500">/</span>
            <span class="text-gray-800">{{ __('Edit Proveedor') }}</span>
        </h2>
    </x-slot>

    <form method="POST" action="{{ route('admin.proveedors.update', $proveedor) }}">
        @csrf
        @method('PUT')

        <div class="max-w-6xl mx-auto mt-6 bg-white rounded-xl shadow p-6">
            <h3 class="text-lg font-bold mb-6 underline underline-offset-4 text-gray-700">
                Editar Proveedor
            </h3>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                <div>
                    <x-label value="Nombre" />
                    <x-input type="text" name="nombre"
                        value="{{ old('nombre', $proveedor->nombre) }}"
                        placeholder="Nombre del proveedor" class="w-full" />
                    <x-input-error for="nombre" />
                </div>

                <div>
                    <x-label value="Teléfono" />
                    <x-input type="text" name="telefono"
                        value="{{ old('telefono', $proveedor->telefono) }}"
                        placeholder="Número de contacto" class="w-full" />
                    <x-input-error for="telefono" />
                </div>

                <div>
                    <x-label value="Correo" />
                    <x-input type="email" name="correo"
                        value="{{ old('correo', $proveedor->correo) }}"
                        placeholder="correo@ejemplo.com" class="w-full" />
                    <x-input-error for="correo" />
                </div>

                <div>
                    <x-label value="Dirección" />
                    <x-input type="text" name="direccion"
                        value="{{ old('direccion', $proveedor->direccion) }}"
                        placeholder="Dirección" class="w-full" />
                    <x-input-error for="direccion" />
                </div>

                <div>
                    <x-label value="DNI" />
                    <x-input type="text" name="dni"
                        value="{{ old('dni', $proveedor->dni) }}"
                        placeholder="DNI" class="w-full" />
                    <x-input-error for="dni" />
                </div>

                <div>
                    <x-label value="Estado" />
                    <select name="estado" class="w-full border-gray-300 rounded-md">
                        <option value="activo"   @selected(old('estado', $proveedor->estado) === 'activo')>Activo</option>
                        <option value="inactivo" @selected(old('estado', $proveedor->estado) === 'inactivo')>Inactivo</option>
                    </select>
                    <x-input-error for="estado" />
                </div>

                {{-- NUEVO: Distrito --}}
                <div>
                    <x-label value="Distrito" />
                    <select name="distrito_id" class="w-full border-gray-300 rounded-md">
                        <option value="">-- Seleccione --</option>
                        @foreach ($distritos as $distrito)
                            <option value="{{ $distrito->id }}"
                                @selected(old('distrito_id', $proveedor->distrito_id) == $distrito->id)>
                                {{ $distrito->name }}
                            </option>
                        @endforeach
                    </select>
                    <x-input-error for="distrito_id" />
                </div>


                <div>
                    <x-label value="Observaciones" />
                    <x-textarea name="observacion" class="w-full">{{ old('observacion', $proveedor->observacion) }}</x-textarea>
                    <x-input-error for="observacion" />
                </div>
            </div>

            <div class="mt-8 text-right">
                <x-danger-button type="submit">
                    <i class="fa-regular fa-floppy-disk mr-2"></i> Actualizar Proveedor
                </x-danger-button>
            </div>
        </div>
    </form>
</x-app-layout>
