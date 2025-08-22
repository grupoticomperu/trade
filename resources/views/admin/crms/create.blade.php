<x-app-layout>
    <x-slot name="header">

        <h2 class="text-xl font-semibold leading-tight text-gray-800 flex items-center space-x-2">
            <!-- Enlace a la lista de usuarios -->
            <a href="{{ route('admin.users.index') }}" class="text-blue-600 no-underline flex items-center space-x-1">
                <!-- Ícono de usuarios -->
                <i class="fas fa-users"></i>
                <span>{{ __('List Users') }}</span>
            </a>
            <!-- Separador -->
            <span class="text-gray-500">/</span>
            <!-- Página actual -->
            <span class="text-gray-800">{{ __('Creando la Oportunidad') }}</span>
        </h2>


    </x-slot>


    <div class="flex flex-col lg:flex-row px-4 mx-auto mt-4 sm:px-6 lg:px-8 gap-6">

        <form method="POST" action="{{ route('admin.proveedors.update', $proveedor) }}" enctype="multipart/form-data"
            class="lg:w-2/6">
            @csrf
            @method('PUT')


            <div class="px-3 bg-white">

                <div class="card card-primary card-outline">
                    <div class="card-body box-profile">
                        <div class="px-3 py-4 bg-white md:col-span-2">

                            {{--  <h3 class="text-center profile-username">Datos del Usuario</h3> --}}
                            {{-- <p class="text-lg font-bold underline underline-offset-2">Datos del Proveedor</p> --}}

                            <p class="text-lg font-bold underline underline-offset-2 mb-4">CRM</p>
                            <div class="mb-4">
                                <x-label value="Nombre:" />
                                <x-input type="text" name="nombrecrm" value="{{ old('nombre', $nombrecrm ?? '') }}"
                                    placeholder="tu  nombre" class="w-full" />
                                <x-input-error for="nombre" />
                            </div>

                            <p class="text-lg font-bold underline underline-offset-2 mb-4">Datos del Proveedor</p>

                            {{--  @include('partials.error-messages') --}}

                            <div class="mb-4">
                                <x-label value="Nombre:" />
                                <x-input type="text" name="nombre"
                                    value="{{ old('name', $proveedor->nombre ?? '') }}" placeholder="tu  nombre"
                                    class="w-full" />
                                <x-input-error for="name" />
                            </div>

                            <div class="mb-4">
                                <x-label value="Email:" />
                                <x-input type="email" name="correo"
                                    value="{{ old('name', $proveedor->correo ?? '') }}" placeholder="ingrese tu Email"
                                    class="w-full" />
                                <x-input-error for="email" />
                            </div>



                            <hr>
                            <div class="mb-4">
                                <x-label value="Dirección:" />
                                <x-input type="text" name="direccion"
                                    value="{{ old('direccion', $proveedor->direccion ?? '') }}" placeholder="Dirección"
                                    class="w-full" />
                                <x-input-error for="direccion" />
                            </div>

                            <div class="mb-4">
                                <x-label value="DNI:" />
                                <x-input type="text" name="dni" value="{{ old('name', $proveedor->dni ?? '') }}"
                                    placeholder="DNI" class="w-full" />
                                <x-input-error for="dni" />
                            </div>



                            <div class="mb-4">
                                <x-label value="Celular:" />
                                <x-input type="text" name="telefono"
                                    value="{{ old('name', $proveedor->telefono ?? '') }}" placeholder="Teléfono"
                                    class="w-full" />
                                <x-input-error for="telefono" />
                            </div>

                            <div>
                                <x-label value="Distrito:" />
                                <select name="distrito_id" class="w-full">
                                    <option value="">Seleccione el distrito</option>
                                    @foreach ($distritos as $distrito)
                                        <option value="{{ $distrito->id }}" @selected(old('distrito_id', $proveedor->distrito_id) == $distrito->id)>
                                            {{ $distrito->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>


                        </div>
                    </div>
                </div>


                <x-danger-button class="w-full mt-1 mb-3" type="submit">
                    <i class="mx-2 fa-regular fa-floppy-disk"></i> Actualizar Proveedor
                </x-danger-button>


            </div>
        </form>


        <form method="POST" action="{{ route('admin.productos.update', $producto->id) }}"
            enctype="multipart/form-data" class="lg:w-4/6">
            @csrf
            @method('PUT')

            <div class="px-3 py-4 bg-white md:col-span-2">



                <p class="text-lg font-bold underline underline-offset-2 mb-4">Datos del Vehículo {{ $producto->id }}
                </p>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">


                    <div>
                        <x-label value="Nombre:" />
                        <x-input type="text" name="nombre" value="{{ old('nombre', $producto->nombre ?? '') }}"
                            class="w-full" />
                    </div>

                    <div>
                        <x-label value="Kilometraje:" />
                        <x-input type="text" name="kilometraje"
                            value="{{ old('kilometraje', $producto->kilometraje ?? '') }}" class="w-full" />
                    </div>



                    <div>
                        <x-label value="Motor:" />
                        <x-input type="text" name="motor" value="{{ old('motor', $producto->motor ?? '') }}"
                            class="w-full" />
                    </div>

                    <div>
                        <x-label value="Número de puertas:" />
                        <x-input type="text" name="numpuertas"
                            value="{{ old('numpuertas', $producto->numpuertas ?? '') }}" class="w-full" />
                    </div>

                    <div>
                        <x-label value="Placa:" />

                        <x-input type="text" name="placa" value="{{ old('placa', $producto->placa ?? '') }}"
                            placeholder="Dirección" class="w-full"/>


                    </div>


                    <div>
                        <x-label value="Precio Venta:" />
                        <x-input type="number" name="precio_venta"
                            value="{{ old('precio_venta', $producto->precio_venta ?? '') }}" class="w-full" />
                    </div>

                    <div>
                        <x-label value="Precio Esperado:" />
                        <x-input type="number" name="precio_esperado"
                            value="{{ old('precio_esperado', $producto->precio_esperado ?? '') }}" class="w-full" />
                    </div>

                    <div>
                        <x-label value="Precio Ofertado:" />
                        <x-input type="number" name="precio_ofertado"
                            value="{{ old('precio_ofertado', $producto->precio_ofertado ?? '') }}" class="w-full" />
                    </div>

                    <div>
                        <x-label value="Deuda:" />
                        <x-input type="text" name="deuda" value="{{ old('deuda', $producto->deuda ?? '') }}"
                            class="w-full" />
                    </div>

                    <div>
                        <x-label value="Banco de deuda:" />
                        <x-input type="text" name="bancodeuda"
                            value="{{ old('bancodeuda', $producto->bancodeuda ?? '') }}" class="w-full" />
                    </div>

                    <div>
                        <x-label value="Precio Compra:" />
                        <x-input type="number" name="precio_compra"
                            value="{{ old('precio_compra', $producto->precio_compra ?? '') }}" class="w-full" />
                    </div>

                    <div>
                        <x-label value="Descuento Administrativo:" />
                        <x-input type="number" name="descuentos_administrativos"
                            value="{{ old('descuentos_administrativos', $producto->descuentos_administrativos ?? '') }}"
                            class="w-full" />
                    </div>

                    <div>
                        <x-label value="Descuento Mecánico:" />
                        <x-input type="number" name="descuentos_mecanicos"
                            value="{{ old('descuentos_mecanicos', $producto->descuentos_mecanicos ?? '') }}"
                            class="w-full" />
                    </div>

                    {{--  <div>
                        <x-label value="Estado:" />
                        <select name="state" class="w-full">
                            <option value="0">Disponible</option>
                            <option value="vendido">Vendido</option>
                            <option value="reservado">Reservado</option>
                        </select>
                    </div> --}}



                    <div>
                        <x-label value="Estado:" />
                        <select name="state" class="w-full">
                            <option value="0" @selected(old('state', $producto->state) == 0)>Disponible</option>
                            <option value="1" @selected(old('state', $producto->state) == 1)>Reservado</option>
                            <option value="2" @selected(old('state', $producto->state) == 2)>Vendido</option>
                            <option value="3" @selected(old('state', $producto->state) == 3)>Comprado</option>
                        </select>
                        <x-input-error for="state" />
                    </div>


                    {{-- <div>
                        <x-label value="Vendedor:" />
                        <select name="user_id" class="w-full">
                            <option value="">Selecciona vendedor</option>
                        </select>
                    </div> --}}

                    {{--  <div>
                        <x-label value="Marca:" />
                        <select name="brand_id" class="w-full">
                            @foreach ($brands as $brand)
                                <option value="{{ $brand->id }}"
                                    {{ old('brand_id', $producto->brand_id) == $brand->id ? 'selected' : '' }}>
                                    {{ $brand->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    --}}

                    <div>
                        <x-label value="Marca:" />
                        <select name="brand_id" class="w-full">
                            @foreach ($brands as $brand)
                                <option value="{{ $brand->id }}"
                                    {{ old('brand_id', $producto->brand_id) == $brand->id ? 'selected' : '' }}>
                                    {{ $brand->name }}
                                </option>
                            @endforeach
                        </select>
                        <x-input-error for="brand_id" />
                    </div>



                    <div>
                        <x-label value="Modelo:" />
                        <select name="modello_id" class="w-full">
                            @foreach ($modellos as $modello)
                                <option value="{{ $modello->id }}"
                                    {{ old('modello_id', $producto->modello_id) == $modello->id ? 'selected' : '' }}>
                                    {{ $modello->name }}
                                </option>
                            @endforeach
                        </select>
                        <x-input-error for="modello_id" />
                    </div>


                    <div>
                        <x-label value="Color:" />
                        <select name="color_id" class="w-full">
                            <option value="">Selecciona color</option>
                            @foreach ($colores as $color)
                                <option value="{{ $color->id }}" @selected(old('color_id', $producto->color_id) == $color->id)>
                                    {{ $color->name }}
                                </option>
                            @endforeach
                        </select>
                        <x-input-error for="color_id" />
                    </div>


                    <div>
                        <x-label value="Año:" />
                        <select name="year_id" class="w-full">
                            @foreach ($years as $year)
                                <option value="{{ $year->id }}"
                                    {{ old('year_id', $producto->year_id) == $year->id ? 'selected' : '' }}>
                                    {{ $year->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>


                    <div>
                        <x-label value="Tracción:" />
                        <select name="traccion_id" class="w-full">
                            <option value="">Selecciona tracción</option>
                            @foreach ($traccions as $t)
                                <option value="{{ $t->id }}" @selected(old('traccion_id', $producto->traccion_id) == $t->id)>{{ $t->name }}
                                </option>
                            @endforeach
                        </select>
                        <x-input-error for="traccion_id" />
                    </div>



                    <div>
                        <x-label value="Transmisión:" />
                        <select name="transmision_id" class="w-full">
                            <option value="">Selecciona transmisión</option>
                            @foreach ($transmisions as $t)
                                <option value="{{ $t->id }}" @selected(old('transmision_id', $producto->transmision_id) == $t->id)>{{ $t->name }}
                                </option>
                            @endforeach
                        </select>
                        <x-input-error for="transmision_id" />
                    </div>

                    <div>
                        <x-label value="Combustible:" />
                        <select name="combustible_id" class="w-full">
                            <option value="">Selecciona combustible</option>
                            @foreach ($combustibles as $c)
                                <option value="{{ $c->id }}" @selected(old('combustible_id', $producto->combustible_id) == $c->id)>{{ $c->name }}
                                </option>
                            @endforeach
                        </select>
                        <x-input-error for="combustible_id" />
                    </div>


                    <div>
                        <x-label value="Categoría:" />
                        <select name="category_id" class="w-full">
                            <option value="">Selecciona categoría</option>
                            @foreach ($categorias as $cat)
                                <option value="{{ $cat->id }}" @selected(old('category_id', $producto->category_id) == $cat->id)>{{ $cat->name }}
                                </option>
                            @endforeach
                        </select>
                        <x-input-error for="category_id" />
                    </div>



                    {{-- <div class="flex items-center space-x-2">
                        <input type="checkbox" name="comprado" id="comprado" value="1"
                            {{ old('comprado', $producto->comprado ?? false) ? 'checked' : '' }}
                            class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring focus:ring-indigo-200" />
                        <x-label for="comprado" value="¿Comprado?" />
                    </div>

                    <div class="flex items-center space-x-2">
                        <input type="checkbox" name="vendido" id="vendido" value="1"
                            {{ old('vendido', $producto->vendido ?? false) ? 'checked' : '' }}
                            class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring focus:ring-indigo-200" />
                        <x-label for="vendido" value="¿Vendido?" />
                    </div> --}}


                </div>

                {{-- @can('Producto Update') --}}
                <x-danger-button class="w-full mt-1 mb-3" type="submit">
                    <i class="mx-2 fa-regular fa-floppy-disk"></i> Actualizar Vehiculo
                </x-danger-button>
                {{-- @endcan --}}



            </div>
        </form>

    </div>







</x-app-layout>
