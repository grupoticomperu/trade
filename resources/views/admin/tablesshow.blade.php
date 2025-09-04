<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('General Menu') }}
        </h2>
    </x-slot>

    <section class="">
        <div class="py-12">
            {{--  <div class="mx-auto max-w-7xl sm:px-6 lg:px-8"> --}}
            {{-- <div class="overflow-hidden bg-white shadow-xl sm:rounded-lg"> --}}

                
            <div
                class="grid grid-cols-1 px-4 mx-auto mt-4 max-w-7xl sm:px-6 lg:px-8 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-x-6 gap-y-8">

                {{--  @can('Configuration View') --}}
                <article>
                    <figure>
                        <img class="object-cover w-full rounded-xl h-36" src="{{ asset('img/configuraciones.jpg') }}"
                            alt="Configuraciones">
                    </figure>
                    <header class="mt-2">
                        <h1 class="text-xl text-center text-gray-700"><a href="{{-- {{route('admin.company.edit', auth()->user()->employee->company->id )}} --}}">Configuraciones</a>
                        </h1>
                    </header>
                </article>
                {{--  @endcan  --}}


                @can('User List')
                    <article>
                        <figure>
                            <img class="object-cover w-full rounded-xl h-36" src="{{ asset('img/usuarios.jpg') }}"
                                alt="Lita de Usuarios">
                        </figure>
                        <header class="mt-2">
                            <h1 class="text-xl text-center text-gray-700"><a
                                    href=" {{ route('admin.users.index') }}">Usuarios</a></h1>
                        </header>

                    </article>
                @endcan

                @can('Permission List')
                    <article>
                        <figure>
                            <img class="object-cover w-full rounded-xl h-36" src="{{ asset('img/permisos.jpg') }}"
                                alt="">
                        </figure>
                        <header class="mt-2">
                            <h1 class="text-xl text-center text-gray-700"><a
                                    href="{{ route('admin.permissions.list') }}">Permisos</a></h1>
                        </header>

                    </article>
                @endcan

                @can('Role List')
                    <article>
                        <figure>
                            <img class="object-cover w-full rounded-xl h-36" src="{{ asset('img/roles.jpg') }}"
                                alt="">
                        </figure>
                        <header class="mt-2">
                            <h1 class="text-xl text-center text-gray-700"><a
                                    href="{{ route('admin.roles.index') }}">Roles</a></h1>
                        </header>

                    </article>
                @endcan


                <article>
                    <figure>
                        <img class="object-cover w-full rounded-xl h-36" src="{{ asset('img/locals.jpg') }}"
                            alt="">
                    </figure>
                    <header class="mt-2">
                        <h1 class="text-xl text-center text-gray-700"><a href="">Tipo Marketing</a>
                        </h1>
                    </header>
                </article>

                 <article>
                    <figure>
                        <img class="object-cover w-full rounded-xl h-36" src="{{ asset('img/locals.jpg') }}"
                            alt="">
                    </figure>
                    <header class="mt-2">
                        <h1 class="text-xl text-center text-gray-700"><a href="{{ route('admin.leads.index') }}">Leads</a>
                        </h1>
                    </header>
                </article>


                <article>
                    <figure>
                        <img class="object-cover w-full rounded-xl h-36" src="{{ asset('img/proveedores.jpg') }}"
                            alt="">
                    </figure>
                    <header class="mt-2">
                        <h1 class="text-xl text-center text-gray-700"><a href="">Proveedores</a>
                        </h1>
                    </header>
                </article>

                <article>
                    <figure>
                        <img class="object-cover w-full rounded-xl h-36" src="{{ asset('img/categorias.jpg') }}"
                            alt="">
                    </figure>
                    <header class="mt-2">
                        <h1 class="text-xl text-center text-gray-700"><a href="{{ route('category.list') }}">Categorias</a>
                        </h1>
                    </header>
                </article>

                <article>
                    <figure>
                        <img class="object-cover w-full rounded-xl h-36" src="{{ asset('img/productos.jpg') }}"
                            alt="">
                    </figure>
                    <header class="mt-2">
                        <h1 class="text-xl text-center text-gray-700"><a href="{{ route('admin.productos.index') }}">Productos</a>
                        </h1>
                    </header>
                </article>

                <article>
                    <figure>
                        <img class="object-cover w-full rounded-xl h-36" src="{{ asset('img/marcas.jpg') }}"
                            alt="">
                    </figure>
                    <header class="mt-2">
                        <h1 class="text-xl text-center text-gray-700"><a href="">Marcas</a>
                        </h1>
                    </header>

                </article>

                <article>
                    <figure>
                        <img class="object-cover w-full rounded-xl h-36" src="{{ asset('img/modelos.jpg') }}"
                            alt="">
                    </figure>
                    <header class="mt-2">
                        <h1 class="text-xl text-center text-gray-700"><a href="">Modelos</a>
                        </h1>
                    </header>
                </article>

                <article>
                    <figure>
                        <img class="object-cover w-full rounded-xl h-36" src="{{ asset('img/colores.jpg') }}"
                            alt="">
                    </figure>
                    <header class="mt-2">
                        <h1 class="text-xl text-center text-gray-700"><a href="">Colores</a>
                        </h1>
                    </header>
                </article>

                <article>
                    <figure>
                        <img class="object-cover w-full rounded-xl h-36" src="{{ asset('img/anios2.jpg') }}"
                            alt="">
                    </figure>
                    <header class="mt-2">
                        <h1 class="text-xl text-center text-gray-700"><a href="">Años</a>
                        </h1>
                    </header>
                </article>

                <article>
                    <figure>
                        <img class="object-cover w-full rounded-xl h-36" src="{{ asset('img/combustibles.jpg') }}"
                            alt="">
                    </figure>
                    <header class="mt-2">
                        <h1 class="text-xl text-center text-gray-700"><a href="">Combustibles</a>
                        </h1>
                    </header>
                </article>

                <article>
                    <figure>
                        <img class="object-cover w-full rounded-xl h-36" src="{{ asset('img/transmision.jpg') }}"
                            alt="">
                    </figure>
                    <header class="mt-2">
                        <h1 class="text-xl text-center text-gray-700"><a href="">Transmisión</a>
                        </h1>
                    </header>
                </article>

                <article>
                    <figure>
                        <img class="object-cover w-full rounded-xl h-36" src="{{ asset('img/traccion.jpg') }}"
                            alt="">
                    </figure>
                    <header class="mt-2">
                        <h1 class="text-xl text-center text-gray-700"><a href="">Tracción</a>
                        </h1>
                    </header>
                </article>


                <article>
                    <figure>
                        <img class="object-cover w-full rounded-xl h-36" src="{{ asset('img/compras.jpg') }}"
                            alt="">
                    </figure>
                    <header class="mt-2">
                        <h1 class="text-xl text-center text-gray-700"><a href="{{ route('admin.crms.index') }}">CRM</a>
                        </h1>
                    </header>
                </article> 


                <article>
                    <figure>
                        <img class="object-cover w-full rounded-xl h-36" src="{{ asset('img/compras.jpg') }}"
                            alt="">
                    </figure>
                    <header class="mt-2">
                        <h1 class="text-xl text-center text-gray-700"><a href="{{ route('admin.crms.ganados') }}">Ganados</a>
                        </h1>
                    </header>
                </article> 


                <article>
                    <figure>
                        <img class="object-cover w-full rounded-xl h-36" src="{{ asset('img/compras.jpg') }}"
                            alt="">
                    </figure>
                    <header class="mt-2">
                        <h1 class="text-xl text-center text-gray-700"><a href="{{ route('admin.compras.index') }}">Compras</a>
                        </h1>
                    </header>
                </article> 
                

                <article>
                    <figure>
                        <img class="object-cover w-full rounded-xl h-36" src="{{ asset('img/crm.jpg') }}"
                            alt="">
                    </figure>
                    <header class="mt-2">
                        <h1 class="text-xl text-center text-gray-700"><a href="{{ route('admin.crms.index') }}">CRM</a>
                        </h1>
                    </header>
                </article>

                <article>
                    <figure>
                        <img class="object-cover w-full rounded-xl h-36" src="{{ asset('img/etapas.jpg') }}"
                            alt="">
                    </figure>
                    <header class="mt-2">
                        <h1 class="text-xl text-center text-gray-700"><a href="">Etapas</a>
                        </h1>
                    </header>
                </article>


                 <article>
                    <figure>
                        <img class="object-cover w-full rounded-xl h-36" src="{{ asset('img/seguimiento.jpg') }}"
                            alt="">
                    </figure>
                    <header class="mt-2">
                        <h1 class="text-xl text-center text-gray-700"><a href="">Seguimiento</a>
                        </h1>
                    </header>
                </article>


                <article>
                    <figure>
                        <img class="object-cover w-full rounded-xl h-36" src="{{ asset('img/ventas.jpg') }}"
                            alt="">
                    </figure>
                    <header class="mt-2">
                        <h1 class="text-xl text-center text-gray-700"><a href="">Ventas</a>
                        </h1>
                    </header>
                </article>
                
                <article>
                    <figure>
                        <img class="object-cover w-full rounded-xl h-36" src="{{ asset('img/clientes.jpg') }}"
                            alt="">
                    </figure>
                    <header class="mt-2">
                        <h1 class="text-xl text-center text-gray-700"><a href="">Clientes</a>
                        </h1>
                    </header>
                </article>
                {{-- @can('Local View')
                                <article>
                                    <figure>
                                        <img class="object-cover w-full rounded-xl h-36" src="{{asset('img/locals.jpg')}}" alt="">
                                    </figure>
                                    <header class="mt-2">
                                        <h1 class="text-xl text-center text-gray-700"><a href="{{route('local.list')}}">Locales</a></h1>
                                    </header>

                                </article>
                                @endcan


                                @can('Brand View')
                                <article>
                                    <figure>
                                        <img class="object-cover w-full rounded-xl h-36" src="{{asset('img/brands.jpg')}}" alt="">
                                    </figure>
                                    <header class="mt-2">
                                        <h1 class="text-xl text-center text-gray-700"><a href="{{route('brand.list')}}">Marcas</a></h1>
                                    </header>

                                </article>
                                @endcan

                                @can('Category View')
                                <article>
                                    <figure>
                                        <img class="object-cover w-full rounded-xl h-36" src="{{asset('img/categories.jpg')}}" alt="">
                                    </figure>
                                    <header class="mt-2">
                                        <h1 class="text-xl text-center text-gray-700"><a href="{{route('category.listd')}}">Categorias</a></h1>

                                    </header>

                                </article>
                                @endcan



                                @can('Modelo View')
                                <article>
                                    <figure>
                                        <img class="object-cover w-full rounded-xl h-36" src="{{asset('img/modelos.jpg')}}" alt="">
                                    </figure>
                                    <header class="mt-2">
                                        <h1 class="text-xl text-center text-gray-700"><a href="{{route('modelo.list')}}">Modelos</a></h1>
                                    </header>

                                </article>
                                @endcan


                                @can('Product View')
                                <article>
                                    <figure>
                                        <img class="object-cover w-full rounded-xl h-36" src="{{asset('img/productservice2.jpg')}}" alt="TICOMSOFTWARE">
                                    </figure>
                                    <header class="mt-2">
                                        <h1 class="text-xl text-center text-gray-700"><a href="{{route('product.list')}}">Productos</a></h1>
                                    </header>

                                </article>
                                @endcan


                                <article>
                                    <figure>
                                        <img class="object-cover w-full rounded-xl h-36" src="{{asset('img/customers.jpg')}}" alt="TICOMSOFTWARE">
                                    </figure>
                                    <header class="mt-2">
                                        <h1 class="text-xl text-center text-gray-700"><a href="{{route('customer.list')}}">Clientes</a></h1>
                                    </header>

                                </article>




                                @can('Sale View')
                                <article>
                                    <figure>
                                        <img class="object-cover w-full rounded-xl h-36" src="{{asset('img/pos.jpg')}}" alt="">
                                    </figure>
                                    <header class="mt-2">
                                        <h1 class="text-xl text-center text-gray-700"><a href="{{route('admin.comprobante.list')}}">POS</a></h1>
                                    </header>

                                </article>
                                @endcan

                                @can('Sale View')
                                <article>
                                    <figure>
                                        <img class="object-cover w-full rounded-xl h-36" src="{{asset('img/1.jpg')}}" alt="">
                                    </figure>
                                    <header class="mt-2">
                                        <h1 class="text-xl text-center text-gray-700"><a href="{{route('admin.resumen.list')}}">Resumenes</a></h1>
                                    </header>

                                </article>
                                 @endcan  --}}








            </div>
            {{-- </div> --}}
            {{-- </div> --}}
        </div>




    </section>



    <section class="content-center">
        <div class="mt-4 bg-white shadow ">
            <p class="p-2 text-center">TICOM SOFTWARE</p>
        </div>
    </section>

</x-app-layout>
