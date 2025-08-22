<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800 flex items-center space-x-2">
            <a href="{{ route('admin.crms.index') }}" class="text-blue-600 no-underline flex items-center space-x-1">
                <i class="fas fa-briefcase"></i>
                <span>{{ __('Lista CRMs') }}</span>
            </a>
            <span class="text-gray-500">/</span>
            <span class="text-gray-800">{{ __('Detalle CRM') }}</span>
        </h2>
    </x-slot>

    <div class="max-w-4xl mx-auto mt-6 p-6 bg-white rounded-xl shadow">
        {{-- Mensaje de éxito --}}
        @if(session('success'))
            <div class="p-3 mb-4 bg-green-100 text-green-700 rounded">
                {{ session('success') }}
            </div>
        @endif

        <h3 class="text-lg font-bold mb-6 underline underline-offset-4 text-gray-700">
            Información del CRM
        </h3>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 mb-6">
            <div>
                <p><strong>Proveedor:</strong> {{ $crm->proveedor->nombre ?? 'No asignado' }}</p>
                <p><strong>Vehículo:</strong> {{ $crm->producto->nombre ?? 'No asignado' }}</p>
                <p><strong>Usuario asignado:</strong> {{ $crm->user->name ?? 'No asignado' }}</p>
            </div>
            <div>
                <p><strong>Fecha derivación:</strong> {{ $crm->fechaderivacion ?? '-' }}</p>
                <p><strong>Fecha oportunidad:</strong> {{ $crm->fechaoportunidad ?? '-' }}</p>
                <p><strong>Fecha registro:</strong> {{ $crm->created_at->format('d/m/Y') }}</p>
            </div>
        </div>

        {{-- Formulario SOLO para cambiar etapa --}}
        <form action="{{ route('admin.crms.update', $crm) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-6">
                <x-label for="etapa_id" value="Etapa" />
                <select name="etapa_id" id="etapa_id" class="w-full border-gray-300 rounded-md">
                    @foreach($etapas as $etapa)
                        <option value="{{ $etapa->id }}" 
                            {{ $crm->etapa_id == $etapa->id ? 'selected' : '' }}>
                            {{ $etapa->name }}
                        </option>
                    @endforeach
                </select>
                <x-input-error for="etapa_id" />
            </div>

            <div class="text-right">
                <x-danger-button type="submit">
                    <i class="fa-regular fa-floppy-disk mr-2"></i> Guardar cambios
                </x-danger-button>
            </div>
        </form>
    </div>
</x-app-layout>
