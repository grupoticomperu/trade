<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800 flex items-center space-x-2">
            <a href="{{ route('admin.productos.index') }}" class="text-blue-600 no-underline flex items-center space-x-1">
                <i class="fas fa-car-side"></i>
                <span>{{ __('List Productos') }}</span>
            </a>
            <span class="text-gray-500">/</span>
            <span class="text-gray-800">{{ __('Edit Producto') }}</span>
        </h2>
    </x-slot>

    <form method="POST" action="{{ route('admin.productos.update', $producto) }}">
        @csrf
        @method('PUT')

        <div class="max-w-6xl mx-auto mt-6 bg-white rounded-xl shadow p-6">
            <h3 class="text-lg font-bold mb-6 underline underline-offset-4 text-gray-700">
                Editar Producto
            </h3>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">

                <div>
                    <x-label value="Nombre" />
                    <x-input type="text" name="nombre" value="{{ old('nombre', $producto->nombre) }}"
                        placeholder="Nombre del producto" class="w-full" />
                    <x-input-error for="nombre" />
                </div>

                <div>
                    <x-label value="Kilometraje" />
                    <x-input type="text" name="kilometraje" value="{{ old('kilometraje', $producto->kilometraje) }}"
                        placeholder="Ej: 50,000 km" class="w-full" />
                    <x-input-error for="kilometraje" />
                </div>

                <div>
                    <x-label value="Motor" />
                    <x-input type="text" name="motor" value="{{ old('motor', $producto->motor) }}"
                        placeholder="Motor" class="w-full" />
                    <x-input-error for="motor" />
                </div>

                <div>
                    <x-label value="N° Puertas" />
                    <x-input type="number" name="numpuertas" value="{{ old('numpuertas', $producto->numpuertas) }}"
                        placeholder="4" class="w-full" />
                    <x-input-error for="numpuertas" />
                </div>

                <div>
                    <x-label value="Placa" />
                    <x-input type="text" name="placa" value="{{ old('placa', $producto->placa) }}"
                        placeholder="ABC-123" class="w-full" />
                    <x-input-error for="placa" />
                </div>

                <div>
                    <x-label value="Precio Esperado" />
                    <x-input type="number" step="0.01" name="precio_esperado"
                        value="{{ old('precio_esperado', $producto->precio_esperado) }}" placeholder="Precio esperado"
                        class="w-full" />
                    <x-input-error for="precio_esperado" />
                </div>



                <div>
                    <x-label value="Precio Compra" />
                    <x-input type="number" step="0.01" name="precio_compra" id="precio_compra"
                        value="{{ old('precio_compra', $producto->precio_compra) }}" placeholder="Precio compra"
                        class="w-full bg-gray-100" readonly />
                    <x-input-error for="precio_compra" />
                </div>




                <div>
                    <x-label value="Precio Ofertado" />
                    <x-input type="number" step="0.01" name="precio_ofertado" id="precio_ofertado"
                        value="{{ old('precio_ofertado', $producto->precio_ofertado) }}" placeholder="Precio ofertado"
                        class="w-full" />
                    <x-input-error for="precio_ofertado" />
                </div>

                <div>
                    <x-label value="Descuentos Administrativos" />
                    <x-input type="number" step="0.01" name="descuentos_administrativos"
                        id="descuentos_administrativos"
                        value="{{ old('descuentos_administrativos', $producto->descuentos_administrativos) }}"
                        placeholder="Descuentos administrativos" class="w-full" />
                    <x-input-error for="descuentos_administrativos" />
                </div>

                <div>
                    <x-label value="Descuentos Mecánicos" />
                    <x-input type="number" step="0.01" name="descuentos_mecanicos" id="descuentos_mecanicos"
                        value="{{ old('descuentos_mecanicos', $producto->descuentos_mecanicos) }}"
                        placeholder="Descuentos mecánicos" class="w-full" />
                    <x-input-error for="descuentos_mecanicos" />
                </div>

                <div>
                    <x-label value="Deuda" />
                    <x-input type="text" name="deuda" value="{{ old('deuda', $producto->deuda) }}"
                        placeholder="Monto de deuda" class="w-full" />
                    <x-input-error for="deuda" />
                </div>

                <div>
                    <x-label value="Banco Deuda" />
                    <x-input type="text" name="bancodeuda" value="{{ old('bancodeuda', $producto->bancodeuda) }}"
                        placeholder="Banco de deuda" class="w-full" />
                    <x-input-error for="bancodeuda" />
                </div>

                <div>
                    <x-label value="Precio Venta" />
                    <x-input type="number" step="0.01" name="precio_venta"
                        value="{{ old('precio_venta', $producto->precio_venta) }}" placeholder="Precio venta"
                        class="w-full" />
                    <x-input-error for="precio_venta" />
                </div>

                <div>
                    <x-label value="Estado" />
                    <select name="state" class="w-full border-gray-300 rounded-md">
                        <option value="0" @selected(old('state', $producto->state) == 0)>Disponible</option>
                        <option value="1" @selected(old('state', $producto->state) == 1)>Reservado</option>
                        <option value="2" @selected(old('state', $producto->state) == 2)>Vendido</option>
                        <option value="3" @selected(old('state', $producto->state) == 3)>Comprado</option>
                    </select>
                    <x-input-error for="state" />
                </div>

                {{-- RELACIONES --}}
                <div>
                    <x-label value="Proveedor" />
                    <select name="proveedor_id" class="w-full border-gray-300 rounded-md">
                        <option value="">-- Seleccione --</option>
                        @foreach ($proveedores as $prov)
                            <option value="{{ $prov->id }}" @selected(old('proveedor_id', $producto->proveedor_id) == $prov->id)>
                                {{ $prov->nombre }}
                            </option>
                        @endforeach
                    </select>
                    <x-input-error for="proveedor_id" />
                </div>

              
                <div class="col-span-3">

                @livewire('admin.producto-form', ['producto' => $producto])

                </div>
                


                <div>
                    <x-label value="Color" />
                    <select name="color_id" class="w-full border-gray-300 rounded-md">
                        <option value="">-- Seleccione --</option>
                        @foreach ($colors as $color)
                            <option value="{{ $color->id }}" @selected(old('color_id', $producto->color_id) == $color->id)>
                                {{ $color->name }}
                            </option>
                        @endforeach
                    </select>
                    <x-input-error for="color_id" />
                </div>

                <div>
                    <x-label value="Año" />
                    <select name="year_id" class="w-full border-gray-300 rounded-md">
                        <option value="">-- Seleccione --</option>
                        @foreach ($years as $year)
                            <option value="{{ $year->id }}" @selected(old('year_id', $producto->year_id) == $year->id)>
                                {{ $year->name }}
                            </option>
                        @endforeach
                    </select>
                    <x-input-error for="year_id" />
                </div>

                <div>
                    <x-label value="Tracción" />
                    <select name="traccion_id" class="w-full border-gray-300 rounded-md">
                        <option value="">-- Seleccione --</option>
                        @foreach ($tracciones as $trac)
                            <option value="{{ $trac->id }}" @selected(old('traccion_id', $producto->traccion_id) == $trac->id)>
                                {{ $trac->name }}
                            </option>
                        @endforeach
                    </select>
                    <x-input-error for="traccion_id" />
                </div>

                <div>
                    <x-label value="Transmisión" />
                    <select name="transmision_id" class="w-full border-gray-300 rounded-md">
                        <option value="">-- Seleccione --</option>
                        @foreach ($transmisiones as $tran)
                            <option value="{{ $tran->id }}" @selected(old('transmision_id', $producto->transmision_id) == $tran->id)>
                                {{ $tran->name }}
                            </option>
                        @endforeach
                    </select>
                    <x-input-error for="transmision_id" />
                </div>

                <div>
                    <x-label value="Combustible" />
                    <select name="combustible_id" class="w-full border-gray-300 rounded-md">
                        <option value="">-- Seleccione --</option>
                        @foreach ($combustibles as $comb)
                            <option value="{{ $comb->id }}" @selected(old('combustible_id', $producto->combustible_id) == $comb->id)>
                                {{ $comb->name }}
                            </option>
                        @endforeach
                    </select>
                    <x-input-error for="combustible_id" />
                </div>

                <div>
                    <x-label value="Categoría" />
                    <select name="category_id" class="w-full border-gray-300 rounded-md">
                        <option value="">-- Seleccione --</option>
                        @foreach ($categorias as $cat)
                            <option value="{{ $cat->id }}" @selected(old('category_id', $producto->category_id) == $cat->id)>
                                {{ $cat->name }}
                            </option>
                        @endforeach
                    </select>
                    <x-input-error for="category_id" />
                </div>
            </div>

            <div class="mt-8 text-right">
                <x-danger-button type="submit">
                    <i class="fa-regular fa-floppy-disk mr-2"></i> Actualizar Producto
                </x-danger-button>
            </div>
        </div>
    </form>


    @push('scripts')
        <script>
            function calcularPrecioCompra() {
                let po = parseFloat(document.getElementById('precio_ofertado').value) || 0;
                let da = parseFloat(document.getElementById('descuentos_administrativos').value) || 0;
                let dm = parseFloat(document.getElementById('descuentos_mecanicos').value) || 0;

                let pc = po - da - dm;
                document.getElementById('precio_compra').value = pc.toFixed(2);
            }

            document.getElementById('precio_ofertado').addEventListener('input', calcularPrecioCompra);
            document.getElementById('descuentos_administrativos').addEventListener('input', calcularPrecioCompra);
            document.getElementById('descuentos_mecanicos').addEventListener('input', calcularPrecioCompra);

            // Calcular al cargar la página también
            calcularPrecioCompra();
        </script>
    @endpush


</x-app-layout>
