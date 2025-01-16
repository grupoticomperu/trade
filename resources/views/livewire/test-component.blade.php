<div>

    <x-slot name="header">
        <div class="flex items-center">
            <h2 class="text-xl font-semibold leading-tight text-gray-600">
                <a href="#" class="text-blue-600 no-underline flex items-center space-x-1">
                    <!-- Ícono de usuarios -->
                    <i class="fas fa-users"></i>
                    <span>{{ __('List Users') }}</span>
                </a>
            </h2>


        </div>
    </x-slot>


    <h1>{{ $message }}</h1>
    <input type="text" wire:model="message">
</div>