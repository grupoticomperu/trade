<div class="p-6 lg:p-8 bg-white border-b border-gray-200 text-center">
    <x-application-logo class="block h-12 w-auto mx-auto" />

    <h1 class="mt-8 text-3xl font-bold text-gray-900">
        Error 404 - La página que buscaste no existe
    </h1>

    <p class="mt-6 text-gray-600 leading-relaxed mb-4">
        Lo sentimos, la página que intentaste acceder no está disponible o no existe. 
        Si crees que esto es un error, por favor contacta al administrador del sistema.
    </p>

    <a href="{{ route('admin.showtables') }}" {{ $attributes->merge(['class' => 'inline-flex items-center justify-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 active:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150']) }}>
        <i class="mx-2 fa-regular fa-floppy-disk"></i>Ir al ménu principal
    </a>

</div>