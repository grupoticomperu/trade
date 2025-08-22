<div wire:init="loadCategories">

    <x-slot name="header">
        <div class="flex items-center">
            <h2 class="text-xl font-semibold leading-tight text-gray-600">
                Lista de Categorias
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



                @can('Category Create')
                    @livewire('admin.category-create')
                @endcan


            </div>


            @if (count($categories))

                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>

                            <th scope="col"
                                class="w-24 px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase cursor-pointer">

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
                                class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase cursor-pointer">

                                Categoria
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
                                class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase cursor-pointer">
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

                        @foreach ($categories as $categoryy)
                            <tr>

                                <td class="px-6 py-4 text-sm text-gray-500 whitespace-nowrap">
                                    {{ $categoryy->id }}
                                </td>

                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0 w-10 h-10">
                                            @if ($categoryy->image)
                                                <img class="object-cover w-10 h-10 rounded"
                                                    src="{{ url($categoryy->image) }}" alt="">

                                                {{-- src="{{ Storage::disk("s3")->url($categoryy->image) }}" alt=""> --}}
                                                {{-- src="{{ Storage::url($categoryy->image) }}" --}}
                                            @else
                                                {{-- <img class="object-cover w-10 h-10 rounded-full"
                                                                src="storage/categories/default.jpg" alt=""> --}}
                                            @endif
                                        </div>
                                        <div class="ml-4">
                                            <div class="text-sm font-medium text-gray-900">
                                                {{ $categoryy->name }}
                                            </div>
                                        </div>
                                    </div>
                                </td>



                                <td class="px-6 py-4 whitespace-nowrap">
                                   
                                    @switch($categoryy->state)
                                        @case(0)
                                            <span wire:click="activar({{ $categoryy->id }})"
                                                class="inline-flex px-2 text-xs font-semibold leading-5 text-red-800 bg-red-100 rounded-full cursor-pointer">
                                                inactivo
                                            </span>
                                        @break

                                        @case(1)
                                            <span wire:click="desactivar({{ $categoryy->id }})"
                                                class="inline-flex px-2 text-xs font-semibold leading-5 text-green-800 bg-green-100 rounded-full cursor-pointer">
                                                activo
                                            </span>
                                        @break

                                        @default
                                    @endswitch

                                </td>




                                <td class="px-6 py-4 text-sm font-medium text-right whitespace-nowrap">
                                    {{-- <a href="" class="btn btn-blue"><i class="fa-sharp fa-solid fa-eye"></i></a> --}}
                                    @can('Category Update')
                                        <a wire:click="edit({{ $categoryy }})" class="mr-1 btn btn-green">
                                            <i class="fa-solid fa-pen-to-square"></i>
                                        </a>
                                    @endcan

                                    {{-- @can('Category Delete')
                                            <a class="btn btn-red"
                                                wire:click="$emit('deleteCategory', {{ $categoryy->id }})">
                                                <i class="fa-solid fa-trash-can"></i>
                                            </a>
                                        @endcan --}}

                                    <a class="btn btn-red" wire:click="confirmarEliminado({{ $categoryy->id }})">
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

                @if ($categories->hasPages())
                    {{-- existe paginación --}}
                    <div class="px-6 py-8">
                        {{ $categories->links() }}
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
            window.addEventListener('confirmareliminado', event => {
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
                        // Emitir el evento 'eliminar' al backend
                        //$wire.dispatch('eliminar');
                        //console.log('Emitir evento eliminar'); // Verificar en la consola
                        //Livewire.emit("eliminar");
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
        </script>
    @endpush


</div>
