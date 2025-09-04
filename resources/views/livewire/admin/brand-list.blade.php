<div wire:init="loadBrands">

    <x-slot name="header">
        <div class="flex items-center">
            <h2 class="text-xl font-semibold leading-tight text-gray-600">
                Lista de Marcas
            </h2>
        </div>
    </x-slot>

    <!-- This example requires Tailwind CSS v2.0+ -->
    <div class="container py-12 mx-auto border-gray-400 max-w-7xl sm:px-6 lg:px-8">
        <x-table>

            <div class="items-center px-6 py-4 bg-gray-200 sm:flex">

                <div class="flex items-center justify-center mb-2 md:mb-0">
                    <span>Mostrar </span>
                    <select wire:model="cant"
                        class="block p-7 py-2.5 ml-3 mr-3 text-sm text-gray-900 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">

                        <option value="10"> 10 </option>
                        <option value="25">25</option>
                        <option value="50">50</option>
                        <option value="100">100</option>
                    </select>
                    <span class="mr-3">registros</span>
                </div>


                <div class="flex items-center justify-center mb-2 mr-4 md:mb-0 sm:w-full">
                    <x-input type="text" wire:model="search"
                        class="flex items-center justify-center w-80 sm:w-full rounded-lg py-2.5"
                        placeholder="buscar" />
                </div>

                @can('Brand Create')
                    @livewire('admin.brand-create')
                @endcan


            </div>


            @if (count($brands))

                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>

                            <th scope="col"
                                class="w-24 px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase cursor-pointer"
                                wire:click="order('id')">

                                ID

                                @if ($sort == 'id')
                                    @if ($direction == 'asc')
                                        <i class="float-right mt-1 fas fa-sort-alpha-up-alt"></i>
                                    @else
                                        <i class="float-right mt-1 fas fa-sort-alpha-down-alt"></i>
                                    @endif
                                @else
                                    <i class="float-right mt-1 fas fa-sort"></i>
                                @endif
                            </th>

                            <th scope="col"
                                class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase cursor-pointer"
                                wire:click="order('name')">

                                Marca
                                @if ($sort == 'name')
                                    @if ($direction == 'asc')
                                        <i class="float-right mt-1 fas fa-sort-alpha-up-alt"></i>
                                    @else
                                        <i class="float-right mt-1 fas fa-sort-alpha-down-alt"></i>
                                    @endif
                                @else
                                    <i class="float-right mt-1 fas fa-sort"></i>
                                @endif

                            </th>


                            <th scope="col"
                                class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase cursor-pointer"
                                wire:click="order('name')">
                                Estado
                                @if ($sort == 'state')
                                    @if ($direction == 'asc')
                                        <i class="float-right mt-1 fas fa-sort-alpha-up-alt"></i>
                                    @else
                                        <i class="float-right mt-1 fas fa-sort-alpha-down-alt"></i>
                                    @endif
                                @else
                                    <i class="float-right mt-1 fas fa-sort"></i>
                                @endif


                            </th>

                            <th scope="col"
                                class="px-6 py-3 text-xs font-medium tracking-wider text-right text-gray-500 uppercase">
                                ACCIONES
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">

                        @foreach ($brands as $brand)
                            <tr>
                                <td class="px-6 py-4 text-sm text-gray-500 whitespace-nowrap">
                                    {{ $brand->id }}
                                </td>

                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0 w-10 h-10">
                                            @if ($brand->image)
                                                <img class="object-cover w-10 h-10 rounded"
                                                    src="{{ url($brand->image) }}" alt="">

                                                {{-- src="{{ Storage::disk("s3")->url($brand->image) }}" alt=""> --}}
                                                {{-- src="{{ Storage::url($brand->image) }}" --}}
                                            @else
                                                <img class="object-cover w-10 h-10 rounded-full"
                                                    src="storage/brands/default.jpg" alt="">
                                            @endif
                                        </div>
                                        <div class="ml-4">
                                            <div class="text-sm font-medium text-gray-900">
                                                {{ $brand->name }}
                                            </div>
                                        </div>
                                    </div>
                                </td>



                                <td class="px-6 py-4 whitespace-nowrap">

                                    @switch($brand->state)
                                        @case(0)
                                            <span wire:click="activar({{ $brand->id }})"
                                                class="inline-flex px-2 text-xs font-semibold leading-5 text-red-800 bg-red-100 rounded-full cursor-pointer">
                                                inactivo
                                            </span>
                                        @break

                                        @case(1)
                                            <span wire:click="desactivar({{ $brand->id }})"
                                                class="inline-flex px-2 text-xs font-semibold leading-5 text-green-800 bg-green-100 rounded-full cursor-pointer">
                                                activo
                                            </span>
                                        @break

                                        @default
                                    @endswitch

                                </td>




                                <td class="px-6 py-4 text-sm font-medium text-right whitespace-nowrap">
                                    {{-- <a href="" class="btn btn-blue"><i class="fa-sharp fa-solid fa-eye"></i></a> --}}
                                    @can('Brand Update')
                                        <a wire:click="edit({{ $brand }})" class="mr-1 btn btn-green">
                                            <i class="fa-solid fa-pen-to-square"></i>
                                        </a>
                                    @endcan

                                    {{-- @can('Category Delete')
                                            <a class="btn btn-red"
                                                wire:click="$emit('deleteCategory', {{ $brand->id }})">
                                                <i class="fa-solid fa-trash-can"></i>
                                            </a>
                                        @endcan --}}

                                    <a class="btn btn-red" wire:click="confirmarEliminado({{ $brand->id }})">
                                        <i class="fa-solid fa-trash-can"></i>
                                    </a>



                                    {{-- <a href="" class="btn btn-green"><i class="fa-solid fa-pen-to-square"></i></a>
                                                <a href="" class="btn btn-red"><i class="fa-solid fa-trash-can"></i></a> --}}


                                </td>
                            </tr>
                        @endforeach
                        <!-- More people... -->
                    </tbody>
                </table>

                @if ($brands->hasPages())
                    {{-- existe paginación --}}
                    <div class="px-6 py-8">
                        {{ $brands->links() }}
                    </div>
                @endif
            @else
                <div class="px-6 py-4">
                    No hay ningún registro coincidente
                </div>
            @endif





        </x-table>

    </div>


    <x-slot name="footer">

        <h2 class="text-xl font-semibold leading-tight text-gray-600">
            Pie
        </h2>
    </x-slot>


    @push('scripts')
        {{-- <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script> --}}


        <script>
            document.addEventListener('livewire:navigated', () => {
                Livewire.on('swal:success', (title, text, icon) => {
                    Swal.fire({
                        title: title,
                        text: text,
                        icon: icon, // aquí ya llega el que mandas desde PHP
                        confirmButtonColor: '#3085d6'
                    });
                });

                Livewire.on('borrado', (message) => {
                    Swal.fire({
                        title: "Mensaje del Sistema",
                        text: message || "Registro eliminado correctamente.",
                        icon: "success",
                    });
                });

                Livewire.on('confirmareliminadooo', (message) => {
                    Swal.fire({
                        title: message,
                        text: "No se podrá revertir!",
                        icon: "warning",
                        showCancelButton: true,
                        confirmButtonColor: "#3085d6",
                        cancelButtonColor: "#d33",
                        confirmButtonText: "Sí, eliminar!",
                        cancelButtonText: "Cancelar"
                    }).then((result) => {
                        if (result.isConfirmed) {
                            Livewire.dispatch("eliminar");
                        }
                    });
                });
            });



            /*  window.addEventListener('confirmareliminadooo', event => {
                 Swal.fire({
                     title: event.detail.message,
                     text: "No se podrá revertir!",
                     icon: "warning",
                     showCancelButton: true,
                     confirmButtonColor: "#3085d6",
                     cancelButtonColor: "#d33",
                     confirmButtonText: "Sí, eliminar!",
                     cancelButtonText: "Cancelar"
                 }).then((result) => {
                     if (result.isConfirmed) {
                         
                         Livewire.dispatch("eliminar");
                     }
                 });
             });


             window.addEventListener('borrado', event => {
                 Swal.fire({
                     title: "Mensaje del Sistema",
                     text: event.detail.message || "Registro eliminado correctamente.",
                     icon: "success",
                 });
             });

            


             document.addEventListener('livewire:init', () => {
                 Livewire.on('swal:success', (title, text, icon) => {
                     Swal.fire({
                         title: title,
                         text: text,
                         icon: 'success',
                         confirmButtonColor: '#3085d6'
                     });
                 });
             });
        </script> */
    @endpush


</div>
