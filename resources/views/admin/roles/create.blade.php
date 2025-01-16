<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('New Role') }}
        </h2>
    </x-slot>
    <form method="POST" action="{{ route('admin.roles.store') }}" >
        {{ csrf_field() }}
        <div
            class="grid grid-cols-1 px-4 mx-auto mt-4 sm:px-6 lg:px-8 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-3 gap-x-6 gap-y-8">

            <div class="px-3 bg-white">

                <div class="card card-primary card-outline">
                    <div class="card-body box-profile">
                        <div>
                            {{-- <h3 class="text-center profile-username">Creando Nuevo Rol</h3> --}}
                            <p class="mt-2 mb-2 text-lg font-bold underline underline-offset-2">Creando Nuevo Rol</p>
                            <div class="mb-4">
                                <x-label value="Nombre:" />
                                <x-input type="text" name="name" value="{{ old('name') }}"
                                    placeholder="tu  nombre" class="w-full" />
                                <x-input-error for="name" />
                            </div>

                            <div class="mb-4">
                                <x-label value="Nombre Display:" />
                                <x-input type="text" name="display_name" value="{{ old('display_name') }}"
                                    placeholder="tu  nombre" class="w-full" />
                                <x-input-error for="display_name" />
                            </div>







                        </div>
                    </div>
                </div>

            </div>

            <div class="px-3 py-4 bg-white md:col-span-2">
                <p class="text-lg font-bold underline underline-offset-2">Permisos</p>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4">
                    @include('admin.permissions.checkboxes', ['model' => $role])
                </div>
            </div> 

            {{-- <div class="px-3 py-4 bg-white md:col-span-2">
                <p class="text-lg font-bold underline underline-offset-2">Permisos</p>
                <div class="grid grid-cols-1 gap-4">
                    @include('admin.permissions.checkboxes', ['model' => $role])
                </div>
            </div> --}}



            <x-danger-button class="w-full mt-1 mb-3" type="submit">
                <i class="mx-2 fa-regular fa-floppy-disk"></i> Crear Rol
            </x-danger-button>

        </div>
    </form>
</x-app-layout>
