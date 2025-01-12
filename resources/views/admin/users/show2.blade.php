<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800 flex items-center space-x-2">
            <!-- Enlace a la lista de usuarios -->
            <a href="{{ route('admin.users.index') }}" class="text-blue-600 no-underline flex items-center space-x-1">
                <!-- Ícono de usuarios -->
                <i class="fas fa-users"></i>
                <span>{{ __('List Users') }}</span>
            </a>
            <!-- Separador -->
            <span class="text-gray-500">/</span>
            <!-- Página actual -->
            <span class="text-gray-800">{{ __('User Show') }}</span>
        </h2>

    </x-slot>

    <div
        class="grid grid-cols-1 px-4 mx-auto mt-4 sm:px-6 lg:px-8 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-3 gap-x-6 gap-y-8">

        <div class="px-3 bg-white">

            <div class="card card-primary card-outline">
                <div class="card-body box-profile">
                    <div>

                        <h2 class="text-center profile-username">Datos del Usuario</h2>


                        <div class="w-full py-4 mt-2 bg-slate-50">
                            @if ($user->employee->photo)
                                <img class="w-20 mb-2 ml-4" src="{{ asset('img/' . $user->employee->photo) }}"
                                    alt="usuario">
                            @endif
                        </div>

                        <br>



                        <div class="mb-4">
                            <x-label value="Nombre:" />
                            <x-input type="text" name="name" value="{{ $user->name }}" class="w-full" />

                        </div>

                        <div class="mb-4">
                            <x-label value="Email:" />
                            <x-input type="email" name="email" value="{{ $user->email }}" class="w-full" />

                        </div>



                        <hr>
                        <div class="mt-4 mb-4">
                            <x-label value="Dirección:" />
                            <x-input type="text" name="address" value="{{ $user->employee->address }}"
                                class="w-full" />

                        </div>

                        <div class="flex">
                            <div class="mb-4 mr-4">
                                <x-label value="Celular:" />
                                <x-input type="text" name="movil" value="{{ $user->employee->movil }}"
                                    class="w-full" />

                            </div>

                            <div class="mb-4">
                                <x-label value="DNI:" />
                                <x-input type="text" name="dni" value="{{ $user->employee->dni }}"
                                    class="w-full" />

                            </div>
                        </div>


                        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 lg:gap-2">
                            <div class="mb-4 w-full">
                                <x-label value="Cargo:" />
                                <x-input type="text" name="dni" value="{{ $user->employee->position->name }}"
                                    class="w-full" />
                            </div>

                            <div class="mb-4 w-full">
                                <x-label value="Genero:" />
                                <x-input type="text" name="genero" value="{{ $user->employee->gender_text }}"
                                    class="w-full" />
                            </div>

                            <div class="mb-4 w-full">
                                <x-label value="Local:" />
                                <x-input type="text" name="genero" value="{{ $user->employee->local->name }}"
                                    class="w-full" />
                            </div>
                        </div>

                        <a href="{{  route('admin.users.index') }}"   class="w-full mt-4 mb-3 inline-flex items-center justify-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 active:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">
                            <i class="mx-2 fa-regular fa-floppy-disk"></i> Ir a la lista de Usuarios
                        </a>




                    </div>
                </div>
            </div>

        </div>


        <div class="px-3 py-4 bg-white md:col-span-2">
            <p class="pb-4 text-lg font-bold underline underline-offset-2">Roles</p>
            <div class="mb-4">

                @forelse($user->roles as $role)
                    <strong>{{ $role->name }}</strong>


                    @if ($role->permissions->count())
                        <br>
                        <small class="text-muted">
                            Permisos: {{ $role->permissions->pluck('display_name')->implode(', ') }}
                        </small>
                    @endif
                    @unless ($loop->last)
                        <hr>
                    @endunless

                @empty

                    <small class="text-muted">No tiene Rol Asociado</small>
                @endforelse
            </div>

            <p class="pb-4 text-lg font-bold underline underline-offset-2">Permisos</p>
            <div class="mb-4">
                @forelse($user->permissions as $permission)
                    <small class="text-muted">{{ $permission->display_name }}</small>

                    @unless ($loop->last)
                        <hr>
                    @endunless
                @empty

                    <small class="text-muted">No tiene permisos adicionales</small>
                @endforelse
            </div>

        </div>
    </div>

    </div>

</x-app-layout>
