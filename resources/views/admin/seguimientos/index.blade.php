<x-app-layout>

    <div class="px-6 py-4">

        <a href="{{ route('admin.crms.index') }}"
            class="inline-flex items-center px-3 py-2 rounded-lg bg-slate-600 text-white hover:bg-slate-700">
            <i class="fa-solid fa-arrow-left mr-2"></i> Volver a CRMs
        </a>


        <h2 class="text-xl font-bold mb-4">
            Seguimientos de la oportunidad #{{ $crm->id }}
            @if ($crm->proveedor)
                — {{ $crm->proveedor->nombre }}
            @endif
        </h2>




        @if (session('status'))
            <div class="mb-3 rounded bg-green-50 text-green-700 px-3 py-2 text-sm">
                {{ session('status') }}
            </div>
        @endif




        {{-- Form para agregar seguimiento --}}
        <form method="POST" action="{{ route('admin.crms.seguimientos.store', $crm) }}"
            class="grid grid-cols-1 md:grid-cols-3 gap-3 mb-6">
            @csrf
            <div class="md:col-span-2">
                <x-label value="Nombre del seguimiento" />
                <x-textarea name="nombre" class="w-full" rows="4">{{ old('nombre') }}</x-textarea>
                <x-input-error for="nombre" />
            </div>
            <div class="md:col-span-1">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-3 items-start">
                    <div>
                        <x-label value="Fecha" />
                        <x-input type="date" name="fecha" value="{{ old('fecha', now()->toDateString()) }}"
                            class="w-full" />
                        <x-input-error for="fecha" />
                    </div>

                    <div class="flex md:self-start">
                        {{-- mt-6 aproxima la altura del label para que el botón arranque a la misma altura del input --}}
                        <x-primary-button class="w-full mt-6">Agregar seguimiento</x-primary-button>
                    </div>
                </div>
            </div>
        </form>



        {{-- Tabla de seguimientos --}}
        <div class="overflow-x-auto bg-white rounded shadow">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">ID</th>
                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Nombre</th>
                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Fecha</th>
                        <th class="px-4 py-2 text-right text-xs font-medium text-gray-500 uppercase">Acciones</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @forelse ($seguimientos as $seg)
                        <tr>
                            <td class="px-4 py-2 text-sm text-gray-700">{{ $seg->id }}</td>
                            <td class="px-4 py-2 text-sm text-gray-700">{{ $seg->nombre }}</td>
                            <td class="px-4 py-2 text-sm text-gray-700">
                                {{ optional($seg->fecha)->format('d/m/Y') }}
                            </td>
                            <td class="px-4 py-2 text-sm text-right">
                              {{--  <a href="{{ route('admin.crms.seguimientos.edit', $seg) }}" class="btn btn-green">

                                    <i class="fa-solid fa-pen-to-square"></i>
                                </a>  --}}

                                <button type="button" class="btn btn-green"
                                    onclick="Livewire.dispatch('editar-seguimiento', { id: {{ $seg->id }} })">
                                    <i class="fa-solid fa-pen-to-square"></i>
                                </button>

                                <form action="{{ route('admin.crms.seguimientos.destroy', $seg) }}" method="POST"
                                    class="inline">
                                    @csrf @method('DELETE')
                                    <button class="btn btn-red" onclick="return confirm('¿Eliminar seguimiento?')">
                                        <i class="fa-solid fa-trash-can"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td class="px-4 py-4 text-sm text-gray-500" colspan="4">Sin seguimientos todavía.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

    </div>

    <livewire:admin.seguimientos.edit-modal :contextCrmId="$crm->id" />

</x-app-layout>
