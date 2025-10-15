<div>
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex justify-content-between align-items-center">
                            <h3 class="card-title">Gestión de Años</h3>
                            @can('Year Create')
                            <button wire:click="create" class="btn btn-primary">
                                <i class="fas fa-plus"></i> Nuevo Año
                            </button>
                            @endcan
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <input type="text" wire:model.live="search" class="form-control" placeholder="Buscar años...">
                            </div>
                        </div>

                        <div class="table-responsive">
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Nombre</th>
                                        <th>Fecha de Creación</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($years as $year)
                                    <tr>
                                        <td>{{ $year->id }}</td>
                                        <td>{{ $year->name }}</td>
                                        <td>{{ $year->created_at->format('d/m/Y H:i') }}</td>
                                        <td>
                                            @can('Year Update')
                                            <button wire:click="edit({{ $year->id }})" class="btn btn-sm btn-info">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                            @endcan
                                            @can('Year Delete')
                                            <button onclick="confirmDelete({{ $year->id }})" class="btn btn-sm btn-danger">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                            @endcan
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="4" class="text-center">No hay años registrados</td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>

                        <div class="mt-3">
                            {{ $years->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    @if($isOpen)
    <div class="modal fade show" style="display: block; background-color: rgba(0,0,0,0.5);" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{{ $isEdit ? 'Editar Año' : 'Crear Año' }}</h5>
                    <button type="button" class="btn-close" wire:click="closeModal"></button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="mb-3">
                            <label for="name" class="form-label">Nombre del Año</label>
                            <input type="text" wire:model="name" class="form-control @error('name') is-invalid @enderror" id="name" placeholder="Ej: 2024">
                            @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" wire:click="closeModal">Cancelar</button>
                    @if($isEdit)
                    <button type="button" wire:click="update" class="btn btn-primary">Actualizar</button>
                    @else
                    <button type="button" wire:click="store" class="btn btn-primary">Guardar</button>
                    @endif
                </div>
            </div>
        </div>
    </div>
    @endif

    @push('scripts')
    <script>
        function confirmDelete(id) {
            Swal.fire({
                title: '¿Estás seguro?',
                text: "Esta acción no se puede revertir",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Sí, eliminar',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    @this.dispatch('delete-year', { id: id });
                }
            });
        }

        document.addEventListener('livewire:init', () => {
            Livewire.on('year-created', () => {
                Swal.fire({
                    icon: 'success',
                    title: '¡Éxito!',
                    text: 'Año creado correctamente',
                    timer: 2000,
                    showConfirmButton: false
                });
            });

            Livewire.on('year-updated', () => {
                Swal.fire({
                    icon: 'success',
                    title: '¡Actualizado!',
                    text: 'Año actualizado correctamente',
                    timer: 2000,
                    showConfirmButton: false
                });
            });

            Livewire.on('year-deleted', () => {
                Swal.fire({
                    icon: 'success',
                    title: '¡Eliminado!',
                    text: 'Año eliminado correctamente',
                    timer: 2000,
                    showConfirmButton: false
                });
            });
        });
    </script>
    @endpush
</div>