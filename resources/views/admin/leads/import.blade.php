<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800 flex items-center space-x-2">
            <!-- Enlace a la lista de usuarios -->
            <a href="{{ route('admin.leads.index') }}" class="text-blue-600 no-underline flex items-center space-x-1">
                <!-- Ícono de usuarios -->
                <i class="fas fa-users"></i>
                <span>{{ __('Lista de Leads') }}</span>
            </a>
            <!-- Separador -->
            <span class="text-gray-500">/</span>
            <!-- Página actual -->
            <span class="text-gray-800">{{ __('Importación de Leads') }}</span>
        </h2>



    </x-slot>

    <div class="max-w-3xl mx-auto mt-8 bg-white p-6 rounded shadow">
        @if (session('success'))
            <div class="p-4 mb-4 bg-green-100 text-green-800 rounded">{{ session('success') }}</div>
        @endif

        @if ($errors->any())
            <div class="p-4 mb-4 bg-red-100 text-red-800 rounded">
                <ul class="list-disc list-inside">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admin.leads.import') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="mb-4">
                <x-label value="Seleccionar archivo Excel (.xlsx, .csv)" />
                <x-input type="file" name="file" accept=".xlsx,.csv" class="w-full" />
            </div>

            <x-danger-button type="submit">
                <i class="fa-solid fa-file-import mr-2"></i> Importar Leads
            </x-danger-button>
        </form>
    </div>
</x-app-layout>
