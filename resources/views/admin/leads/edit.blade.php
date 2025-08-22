<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800 flex items-center space-x-2">
            <a href="{{ route('admin.leads.index') }}" class="text-blue-600 flex items-center">
                <i class="fas fa-users mr-1"></i> <span>Leads</span>
            </a>
            <span class="text-gray-500">/</span>
            <span>Editar</span>
        </h2>
    </x-slot>

    <form method="POST" action="{{ route('admin.leads.update', $lead) }}">
        @csrf
        @method('PUT')

        <div class="max-w-6xl mx-auto mt-6 bg-white rounded-xl shadow p-6">
            <h3 class="text-lg font-bold mb-6 underline underline-offset-4 text-gray-700">Editar Lead</h3>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach([
                    'fechaderivacion' => 'Fecha de derivación',
                    'fecha' => 'Fecha',
                    'nombres' => 'Nombres',
                    'telefono' => 'Teléfono',
                    'correoelectronico' => 'Correo Electrónico',
                    'marca' => 'Marca',
                    'modelo' => 'Modelo',
                    'anio' => 'Año',
                    'kilometraje' => 'Kilometraje',
                    'placa' => 'Placa'
                ] as $campo => $etiqueta)
                    <div>
                        <x-label value="{{ $etiqueta }}" />
                        <x-input
                            type="{{ in_array($campo, ['fechaderivacion', 'fecha']) ? 'date' : 'text' }}"
                            name="{{ $campo }}"
                            value="{{ old($campo, $lead->$campo) }}"
                            class="w-full"
                        />
                        <x-input-error for="{{ $campo }}" />
                    </div>
                @endforeach

                <div>
                    <x-label value="Estado" />
                    <select name="state" class="w-full border-gray-300 rounded-md">
                        <option value="">-- Seleccione --</option>
                        <option value="1" {{ old('state', $lead->state) == '1' ? 'selected' : '' }}>Activo</option>
                        <option value="0" {{ old('state', $lead->state) == '0' ? 'selected' : '' }}>Inactivo</option>
                    </select>
                    <x-input-error for="state" />
                </div>

                <div>
                    <x-label value="Usuario Responsable" />
                    <select name="user_id" class="w-full border-gray-300 rounded-md">
                        <option value="">-- Seleccione --</option>
                        @foreach($users as $user)
                            <option value="{{ $user->id }}" {{ old('user_id', $lead->user_id) == $user->id ? 'selected' : '' }}>
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
                        @foreach($tipomarketings as $tipo)
                            <option value="{{ $tipo->id }}" {{ old('tipomarketing_id', $lead->tipomarketing_id) == $tipo->id ? 'selected' : '' }}>
                                {{ $tipo->name }}
                            </option>
                        @endforeach
                    </select>
                    <x-input-error for="tipomarketing_id" />
                </div>

                <div>
                    <x-label value="Observaciones" />
                    <x-textarea name="observacion" class="w-full">{{ old('observacion', $lead->observacion) }}</x-textarea>
                    <x-input-error for="observacion" />
                </div>
            </div>

            <div class="mt-8 text-right">
                <x-danger-button type="submit">
                    <i class="fa-solid fa-pen-to-square mr-2"></i> Actualizar Lead
                </x-danger-button>
            </div>
        </div>
    </form>
</x-app-layout>
