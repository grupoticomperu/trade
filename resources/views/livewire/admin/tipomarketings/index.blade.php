<div>

<div>

    <div class="space-y-6">
        <option value="today">Hoy</option>
        <option value="last7">Últimos 7 días</option>
        <option value="thisMonth">Este mes</option>
        </select>
    </div>
</div>


<div class="flex items-center justify-between mt-2">
    <div class="text-sm text-gray-600 dark:text-gray-300">Resultados: {{ $tipomarketings->total() }}</div>
    <div>
        <select wire:model.live="perPage" class="rounded-xl border-gray-300 dark:bg-gray-800 dark:text-white">
            <option value="10">10</option>
            <option value="25">25</option>
            <option value="50">50</option>
        </select>
    </div>
</div>


<div class="overflow-x-auto">
    <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
        <thead class="bg-gray-50 dark:bg-gray-900">
            <tr>
                <th class="px-4 py-2 text-left text-xs font-semibold uppercase tracking-wider cursor-pointer"
                    wire:click="sortBy('id')">
                    ID
                    @if ($sortField === 'id')
                        <span class="ml-1">{{ $sortDirection === 'asc' ? '▲' : '▼' }}</span>
                    @endif
                </th>
                <th class="px-4 py-2 text-left text-xs font-semibold uppercase tracking-wider cursor-pointer"
                    wire:click="sortBy('name')">
                    Nombre
                    @if ($sortField === 'name')
                        <span class="ml-1">{{ $sortDirection === 'asc' ? '▲' : '▼' }}</span>
                    @endif
                </th>
                <th class="px-4 py-2 text-left text-xs font-semibold uppercase tracking-wider">Orden</th>
                <th class="px-4 py-2 text-right text-xs font-semibold uppercase tracking-wider">Acciones</th>
            </tr>
        </thead>
        <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
            @forelse ($tipomarketings as $row)
                <tr>
                    <td class="px-4 py-2">{{ $row->id }}</td>
                    <td class="px-4 py-2">{{ $row->name }}</td>
                    <td class="px-4 py-2">{{ $row->order }}</td>
                    <td class="px-4 py-2 text-right space-x-2">
                        <a href="{{ route('tipomarketings.edit', $row) }}"
                            class="px-3 py-1 rounded-lg bg-amber-500/90 text-white hover:bg-amber-600">Editar</a>
                        <button type="button" wire:click="confirmDelete({{ $row->id }})"
                            class="px-3 py-1 rounded-lg bg-rose-600 text-white hover:bg-rose-700">Eliminar</button>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="px-4 py-6 text-center text-gray-500 dark:text-gray-300">Sin resultados.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>


<div>
    {{ $tipomarketings->onEachSide(1)->links() }}
</div>



{{-- SweetAlert2 listeners --}}
<script>
    window.addEventListener('swal-confirm-delete', (e) => {
        const {
            id,
            title,
            text
        } = e.detail;
        Swal.fire({
                title,
                text,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Sí, eliminar',
                cancelButtonText: 'Cancelar'
            })
            .then(result => {
                if (result.isConfirmed) {
                    Livewire.dispatch('deleteConfirmed', {
                        id
                    });
                }
            });
    });


    window.addEventListener('swal', (e) => {
        const {
            type,
            title,
            text
        } = e.detail;
        Swal.fire({
            icon: type,
            title,
            text
        });
    });
</script>



</div>
