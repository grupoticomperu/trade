<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800 flex items-center space-x-2">
            <!-- Enlace a la lista de usuarios -->
            <a href="{{ route('admin.users.index') }}" class="text-blue-600 hover:underline flex items-center space-x-1">
                <i class="fas fa-users"></i>
                <span>{{ __('List Users') }}</span>
            </a>
            <!-- Separador -->
            <span class="text-gray-500">/</span>
            <!-- Página actual -->
            <span class="text-gray-800">{{ __('User Show') }}</span>
        </h2>
    </x-slot>

    <div class="px-4 mx-auto mt-6 max-w-7xl sm:px-6 lg:px-8 mb-4">
        <!-- Información del Usuario -->
        <div class="bg-white shadow rounded-lg p-6 mb-6">
            <h3 class="text-lg font-bold text-gray-700 mb-4">Datos del Usuario</h3>
            <div class="flex flex-col lg:flex-row lg:space-x-6">
                <!-- Foto del usuario -->
                @if ($user?->employee?->photo)
                    <img class="w-32 h-32 rounded-full object-cover mx-auto lg:mx-0"
                        src="{{ asset('img/' . ($user?->employee?->photo ?? 'sin foto')) }}" alt="Foto del Usuario">
                @else
                    <div class="w-32 h-32 bg-gray-200 rounded-full mx-auto lg:mx-0 flex items-center justify-center">
                        <i class="text-gray-500 fas fa-user text-3xl"></i>
                    </div>
                @endif

                <!-- Información básica -->
                <div class="flex-1 mt-6 lg:mt-0">
                    <div class="mb-4">
                        <x-label value="Nombre:" />
                        <x-input type="text" value="{{ $user->name }}" class="w-full" disabled />
                    </div>

                    <div class="mb-4">
                        <x-label value="Email:" />
                        <x-input type="email" value="{{ $user->email }}" class="w-full" disabled />
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                        <div>
                            <x-label value="Dirección:" />
                            <x-input type="text" value="{{ $user?->employee?->address ?? 'Sin Dirección' }}" class="w-full" disabled />
                        </div>
                        <div>
                            <x-label value="Celular:" />
                            <x-input type="text" value="{{ $user?->employee?->movil ?? 'Sin Celular' }}" class="w-full" disabled />
                        </div>
                        <div>
                            <x-label value="DNI:" />
                            <x-input type="text" value="{{ $user?->employee?->dni ?? 'Sin DNI'  }}" class="w-full" disabled />
                        </div>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 mt-4">
                        <div>
                            <x-label value="Cargo:" />
                            {{-- <x-input type="text" value="{{ $user->employee->position->name }}" class="w-full" disabled /> --}}
                            <x-input type="text" value="{{ $user->employee->position?->name ?? 'Sin posición asignada' }}" class="w-full" disabled />
                        </div>
                        <div>
                            <x-label value="Género:" />
                            <x-input type="text" value="{{ $user?->employee?->gender_text ?? 'falta seleccionar genero' }}" class="w-full" disabled />
                        </div>
                        <div>
                            <x-label value="Local:" />
                            <x-input type="text" value="{{ $user?->employee?->local->name ?? 'sin local' }}" class="w-full" disabled />
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Roles y Permisos -->
        <div class="bg-white shadow rounded-lg p-6">
            <h3 class="text-lg font-bold text-gray-700 mb-6">Roles y Permisos</h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Roles -->
                <div>
                    <h4 class="text-md font-semibold text-gray-600 mb-2">Roles</h4>
                    <div class="bg-gray-50 rounded-lg p-4">
                        @forelse($user->roles as $role)
                            <div class="mb-2">
                                <strong>{{ $role->name }}</strong>
                                @if ($role->permissions->count())
                                    <br>
                                    <small class="text-gray-500">
                                        Permisos: {{ $role->permissions->pluck('display_name')->implode(', ') }}
                                    </small>
                                @endif
                            </div>
                            @unless($loop->last)
                                <hr class="my-2">
                            @endunless
                        @empty
                            <small class="text-gray-500">No tiene Rol Asociado</small>
                        @endforelse
                    </div>
                </div>

                <!-- Permisos -->
                <div>
                    <h4 class="text-md font-semibold text-gray-600 mb-2">Permisos</h4>
                    <div class="bg-gray-50 rounded-lg p-4">
                        @forelse($user->permissions as $permission)
                            <div class="mb-2">
                                <small class="text-gray-500">{{ $permission->display_name }}</small>
                            </div>
                            @unless($loop->last)
                                <hr class="my-2">
                            @endunless
                        @empty
                            <small class="text-gray-500">No tiene permisos adicionales</small>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>

        <!-- Botón de regreso -->

        <div class="mt-6 mb-6">
            <a href="{{ route('admin.users.index') }}"
                class="inline-flex items-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 active:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition ease-in-out duration-150">
                <i class="fas fa-arrow-left mr-2"></i> Regresar a la lista de Usuarios
            </a>
        </div>

    </div>
</x-app-layout>
