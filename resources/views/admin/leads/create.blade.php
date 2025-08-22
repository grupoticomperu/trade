<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800 flex items-center space-x-2">
            <a href="{{ route('admin.leads.index') }}" class="text-blue-600 no-underline flex items-center space-x-1">
                <i class="fas fa-users"></i>
                <span>{{ __('List Leads') }}</span>
            </a>
            <span class="text-gray-500">/</span>
            <span class="text-gray-800">{{ __('Create Lead') }}</span>
        </h2>
    </x-slot>

    <form method="POST" action="{{ route('admin.leads.store') }}">
        @csrf

        <div class="max-w-6xl mx-auto mt-6 bg-white rounded-xl shadow p-6">
            <h3 class="text-lg font-bold mb-6 underline underline-offset-4 text-gray-700">Registrar nuevo Lead</h3>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                <div>
                    <x-label value="Fecha de derivación" />
                    <x-input type="date" name="fechaderivacion" value="{{ old('fechaderivacion') }}"
                        class="w-full" />
                    <x-input-error for="fechaderivacion" />
                </div>

                <div>
                    <x-label value="Fecha" />
                    <x-input type="date" name="fecha" value="{{ old('fecha') }}" class="w-full" />
                    <x-input-error for="fecha" />
                </div>

                <div>
                    <x-label value="Nombres" />
                    <x-input type="text" name="nombres" value="{{ old('nombres') }}" placeholder="Nombre completo"
                        class="w-full" />
                    <x-input-error for="nombres" />
                </div>

                <div>
                    <x-label value="Teléfono" />
                    <x-input type="text" name="telefono" value="{{ old('telefono') }}"
                        placeholder="Número de contacto" class="w-full" />
                    <x-input-error for="telefono" />
                </div>

                <div>
                    <x-label value="Correo Electrónico" />
                    <x-input type="email" name="correoelectronico" value="{{ old('correoelectronico') }}"
                        placeholder="correo@ejemplo.com" class="w-full" />
                    <x-input-error for="correoelectronico" />
                </div>

                <div>
                    <x-label value="Marca" />
                    <x-input type="text" name="marca" value="{{ old('marca') }}" class="w-full" />
                    <x-input-error for="marca" />
                </div>

                <div>
                    <x-label value="Modelo" />
                    <x-input type="text" name="modelo" value="{{ old('modelo') }}" class="w-full" />
                    <x-input-error for="modelo" />
                </div>

                <div>
                    <x-label value="Año" />
                    <x-input type="text" name="anio" value="{{ old('anio') }}" class="w-full" />
                    <x-input-error for="anio" />
                </div>

                <div>
                    <x-label value="Kilometraje" />
                    <x-input type="text" name="kilometraje" value="{{ old('kilometraje') }}" class="w-full" />
                    <x-input-error for="kilometraje" />
                </div>

                <div>
                    <x-label value="Placa" />
                    <x-input type="text" name="placa" value="{{ old('placa') }}" class="w-full" />
                    <x-input-error for="placa" />
                </div>

                <div>
                    <x-label value="Perfil Coincide" />
                    <select name="state" class="w-full border-gray-300 rounded-md">
                        <option value="">-- Seleccione --</option>
                        <option value="1" {{ old('state') == '1' ? 'selected' : '' }}>Activo</option>
                        <option value="0" {{ old('state') == '0' ? 'selected' : '' }}>Inactivo</option>
                    </select>
                    <x-input-error for="state" />
                </div>

                <div>
                    <x-label value="Usuario Responsable" />
                    <select name="user_id" class="w-full border-gray-300 rounded-md">
                        <option value="">-- Seleccione --</option>
                        @foreach ($users as $user)
                            <option value="{{ $user->id }}" {{ old('user_id') == $user->id ? 'selected' : '' }}>
                                {{ $user->name }}
                            </option>
                        @endforeach
                    </select>
                    <x-input-error for="user_id" />
                </div>

                <div>
                    <x-label value="Tipo de Marketing" />
                    <select name="tipomarketing_id" class="w-full border-gray-300 rounded-md">
                        <option value="">-- Seleccione --</option>
                        @foreach ($tipomarketings as $tipo)
                            <option value="{{ $tipo->id }}"
                                {{ old('tipomarketing_id') == $tipo->id ? 'selected' : '' }}>
                                {{ $tipo->name }}
                            </option>
                        @endforeach
                    </select>
                    <x-input-error for="tipomarketing_id" />
                </div>


                <div>
                    <x-label value="Observaciones" />
                    <x-textarea name="observacion" class="w-full">{{ old('observacion') }}</x-textarea>
                    <x-input-error for="observacion" />
                </div>

            </div>

            <div class="mt-8 text-right">
                @can('Lead Create')
                    <x-danger-button type="submit">
                        <i class="fa-regular fa-floppy-disk mr-2"></i> Crear Lead
                    </x-danger-button>
                @endcan
            </div>
        </div>
    </form>
</x-app-layout>
