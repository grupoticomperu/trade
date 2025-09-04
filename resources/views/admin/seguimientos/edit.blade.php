<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800 flex items-center gap-2">
            <a href="{{ route('admin.crms.seguimientos.index') }}" class="text-blue-600 no-underline flex items-center gap-1">
                <i class="fa-solid fa-list"></i>
                <span>{{ __('List Seguimientos') }}</span>
            </a>
            <span class="text-gray-500">/</span>
            <span class="text-gray-800">{{ __('Edit Seguimiento') }}</span>
        </h2>
    </x-slot>

    {{-- Flash de éxito --}}
    @if (session('success'))
        <div class="max-w-6xl mx-auto mt-6">
            <div class="rounded-lg bg-green-50 border border-green-200 text-green-800 px-4 py-3">
                <i class="fa-regular fa-circle-check mr-2"></i> {{ session('success') }}
            </div>
        </div>
    @endif

    <form method="POST" action="{{ route('admin.crms.seguimientos.update', $seguimiento) }}">
        @csrf
        @method('PUT')

        <div class="max-w-6xl mx-auto mt-6 bg-white rounded-xl shadow p-6">
            <h3 class="text-lg font-bold mb-6 underline underline-offset-4 text-gray-700">
                Editar Seguimiento
            </h3>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">

                {{-- Nombre (text larga -> textarea) --}}
                <div class="sm:col-span-2 lg:col-span-3">
                    <x-label for="nombre" value="Nombre / Descripción del seguimiento" />
                    <textarea
                        id="nombre"
                        name="nombre"
                        rows="4"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                        placeholder="Escribe el detalle del seguimiento...">{{ old('nombre', $seguimiento->nombre) }}</textarea>
                    <x-input-error for="nombre" class="mt-2" />
                </div>

                {{-- CRM (belongsTo) --}}
              {{--   <div>
                    <x-label for="crm_id" value="CRM relacionado" />
                    <select
                        id="crm_id"
                        name="crm_id"
                        class="mt-1 block w-full rounded-md border-gray-300 bg-white shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                    >
                        <option value="">— Sin CRM —</option>
                        @foreach($crms as $id => $name)
                            <option value="{{ $id }}" @selected(old('crm_id', $seguimiento->crm_id) == $id)>{{ $name }}</option>
                        @endforeach
                    </select>
                    <x-input-error for="crm_id" class="mt-2" />
                </div> --}}

                {{-- Fecha --}}
                <div>
                    <x-label for="fecha" value="Fecha" />
                    <x-input
                        id="fecha"
                        type="date"
                        name="fecha"
                        class="mt-1 block w-full"
                        value="{{ old('fecha', optional($seguimiento->fecha)->format('Y-m-d')) }}"
                    />
                    <x-input-error for="fecha" class="mt-2" />
                </div>

            </div>

            <div class="mt-8 flex items-center justify-between">
                <a href="{{ route('admin.seguimientos.index') }}"
                   class="inline-flex items-center gap-2 px-4 py-2 rounded-lg border border-gray-300 text-gray-700 hover:bg-gray-50">
                    <i class="fa-solid fa-arrow-left-long"></i> Volver
                </a>

                <x-danger-button type="submit">
                    <i class="fa-regular fa-floppy-disk mr-2"></i> Actualizar Seguimiento
                </x-danger-button>
            </div>
        </div>
    </form>
</x-app-layout>
